# LDPDWI quiz challenge
## Preview
![screenshot 1 of the quiz](./images/main.png)
## Description
Un quiz est un jeu qui consiste en un questionnaire permettant de tester des connaissances générales
ou spécifiques ou des compétences (source : wikipedia)
On veut réaliser un système web de quiz avec questionnaire à choix multiples. Pour cela, un
questionnaire est représenté dans un tableau PHP contenant :
1. les questions (texte),
2. les choix de réponse (un tableau PHP) au cas où le type de réponses est choix dans une liste,
3. le type de la réponse : choix dans une liste (checkbox) ou texte libre(text),
4. Les bonnes réponses (un autre tableau PHP contenant les bonnes réponses) ou un seule
réponse (texte).

## Travail à faire

• créer un fonction PHP permettant de générer le formulaire html du Quiz correspondant à un
tableau $quest généralisé (donc le traitement supposera que nous avons un nombre n de
questions dans le tableau).
• réaliser le traitement PHP nécessaire permettant de réceptionner les réponses d'un utilisateur
sur le questionnaire et de compter le nombre de réponse juste.
• Tout effort sur la mise en forme et la présentation (CSS) du système web sera le bienvenu.
