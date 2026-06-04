#!/bin/bash

DOSSIER="./facture/input"
FICHIER="facture.pdf"

inotifywait -m "$DOSSIER" -e create |
while read path action file; do
    if [ "$file" = "$FICHIER" ]; then
        
        ocrmypdf facture/input/facture.pdf facture/output/output.pdf
        # docker run --rm \
        # -v "./facture:/facture" \
        # jbarlow83/ocrmypdf \
        # -l fra \
        # /facture/input/facture.pdf \
        # /facture/output/output.pdf

        docker exec pdf_python python3 /site/ocr/pdf2sql.py output.pdf

        rm $DOSSIER/$FICHIER 

        export $(grep -v '^#' ../../.env | xargs)

        docker exec -i bdd mysql -u root -p"$DB_ROOT_PASSWORD" "$DB_NAME" < scriptSQL/output.sql 
        
    fi
done