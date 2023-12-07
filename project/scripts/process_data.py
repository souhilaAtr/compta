import spacy
import logging
import json
import sys

logging.basicConfig(level=logging.DEBUG)

def process_tesseract_data(tesseract_output):
    # Utilise spaCy pour traiter les données Tesseract
    nlp = spacy.load("fr_core_news_sm")
    doc = nlp(tesseract_output)

    # Initialise les variables pour stocker les données
    ter_found = False
    rouen_found = False
    tcn_found = False
    pao_found = False
    processed_data = {
        "ter_info": None,
        "rouen_info": None,
        "tcn_info": None,
        "pao_info": None
    }

    # Parcourt les phrases du texte
    for sentence in doc.sents:
        logging.debug(f"Analyzing sentence: {sentence.text}")

     
        # Vérifie si "ROUEN" est dans la phrase et récupère les mots suivants
        if "ROUEN" in sentence.text.upper():
            rouen_found = True
            processed_data["rouen_info"] = " ".join([str(token) for token in sentence if token.is_alpha])

        # Vérifie si "TER" est dans la phrase et récupère les mots suivants
        if "TER" in sentence.text.upper():
            ter_found = True
            processed_data["ter_info"] = " ".join([str(token) for token in sentence if token.is_alpha])

        # Vérifie si "TCN :" est dans la phrase et récupère les mots suivants
        if "TCN :" in sentence.text:
            tcn_found = True
            tcn_index = sentence.text.find("TCN :")
            tcn_info = sentence.text[tcn_index + 5:].strip()
            processed_data["tcn_info"] = tcn_info

        # Vérifie si "PAO :" est dans la phrase et récupère les mots suivants
        if "PAO " in sentence.text:
            pao_found = True
            pao_index = sentence.text.find("PAO ")
            pao_info = sentence.text[pao_index + 5:].strip()
            processed_data["pao_info"] = pao_info

      

    return processed_data

if __name__ == "__main__":
    # Récupère les données Tesseract à partir des arguments de la ligne de commande
    tesseract_output = sys.argv[1] if len(sys.argv) > 1 else ""
    
    # Traite les données Tesseract avec spaCy
    result = process_tesseract_data(tesseract_output)

    # Convertit les résultats en JSON et imprime
    print(json.dumps(result))
