#!/bin/bash

DOSSIER="./facture/input"
FICHIER="facture.pdf"

inotifywait -m "$DOSSIER" -e create |
while read path action file; do
    if [ "$file" = "$FICHIER" ]; then
        
        ocrmypdf facture/input/facture.pdf facture/output/output.pdf

        docker exec pdf_python python3 /ocr/pdf2sql.py output.pdf

        rm $DOSSIER/$FICHIER 

        export $(grep -v '^#' .env | xargs)

        docker exec -i bdd mysql -u root -p"$DB_ROOT_PASSWORD" "$DB_NAME" < scriptSQL/output.sql 
        
    fi
done