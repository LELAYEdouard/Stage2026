from PyPDF2 import PdfReader
import re
import sys
import json
import os

temp = open(f'/site/ocr/facture/output/{sys.argv[1]}','rb')
pdfread = PdfReader(temp)
pages = pdfread.pages

fichier = open(f"/site/ocr/scriptSQL/{sys.argv[1].replace('.pdf','.sql')}", "w")
resume = open(f"/site/html/fetch.json", "w+")
os.chmod('/site/html/fetch.json',0o777)

jsontxt = {}

for i in range(len(pages)):

    #nettoyage
    # / \ ! {}[]() -> |
    data = pages[i].extract_text().replace("\\","|").replace("{","|").replace("}","|").replace(")","|").replace("(","|").replace("[","|").replace("]","|").replace(";", "|").replace(",", ".").replace("/", "|").replace("!", ".").replace("Î", ".")
    #155555 -> |55555
    err = re.findall(r"^(1\d{5})\|", data, re.MULTILINE)

    for e in err:
        data = data.replace(e,"|"+e[1:])

    match = re.findall(r"^(\d{5}) .* (\d{1,2}) ", data, re.MULTILINE)
    if(not match):
        match = re.findall(r"^\|?(\d{5})\|\s*\|?\s*\d+\s*\|.* (\d{1,2})\|", data, re.MULTILINE)

    for ref,qte in match:
        if(qte != 0):
            fichier.write(f"UPDATE _produit SET quantite = quantite + {qte} WHERE reference = {ref};\n")
        
        jsontxt[ref] = qte


json.dump(jsontxt,resume)

fichier.close()
resume.close()