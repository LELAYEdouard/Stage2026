from PyPDF2 import PdfReader
import re
import sys

temp = open(f'/ocr/facture/output/{sys.argv[1]}','rb')
pdfread = PdfReader(temp)
pages = pdfread.pages

fichier = open(f"/ocr/scriptSQL/{sys.argv[1].replace('.pdf','.sql')}", "w")

for i in range(len(pages)):

    #nettoyage
    # / \ ! {}[]() -> |
    data = pages[i].extract_text().replace("\\","|").replace("{","|").replace("}","|").replace(")","|").replace("(","|").replace("[","|").replace("]","|").replace(";", "|").replace(",", ".").replace("/", "|").replace("!", ".").replace("Î", ".")
    #155555 -> |55555
    err = re.findall(r"^(1\d{5})\|", data, re.MULTILINE)
    # print(err)
    for e in err:
        # print("|"+e[1:])
        data = data.replace(e,"|"+e[1:])
    # print(data)


    match = re.findall(r"^(\d{5}) .* (\d{1,2}) ", data, re.MULTILINE)
    if(not match):
        match = re.findall(r"^\|?(\d{5})\|\s*\|?\s*\d+\s*\|.* (\d{1,2})\|", data, re.MULTILINE)

    for ref,qte in match:
        if(qte != 0):
            fichier.write(f"UPDATE _produit SET quantite = {qte} WHERE reference = {ref};\n")
    


fichier.close()