Project PHP Laravel

 - participants:

    -Pierre Lippens

    -Antonin Perrin


- Les fonctionnalité réalisées:

	Système de gestion utilisateur : on peut:
		- Créer un compte
		- Se connecter avec ses identifiants
		- Avoir accès à un espace personnel
		- Mettre à jour ses informations personnelles
		- Disposer d’une page de profil publique où s’affichent ses récents tweets et retweets dans un
		ordre chronologique
		- Un utilisateur peut suive un autre utilisateur pour voir son contenu dans sa timeline
	Système de Tweets : 
		-L’utilisateur peut écrire des Tweets d’un nombre de caractère limité à 140.
		- Les tweets sont visible seulement par les personnes qui suivent la personne qui
		envoie le tweet
		- Une personne peut retweeter un tweet
		- Une personne peut liker le tweet
		- Seul la personne ayant créer le tweet peut le supprimer / modifier
	Système de timeline : 
		-L’utilisateur peut voir les tweets écrits par les personne qu’il suit
		- Sur la page d’accueil lorsque l’utilisateur est connecté, il voit les derniers tweets des
		personnes qu’il suit (Dans un ordre chronologique)
		- Il peut remonter dans sa timeline pour voir des tweets plus anciens 
		
Bonus Réalisé:
	-Css

Lien du Git:
	git@github.com:perriguigui/TwitterLike.git

Etapes pour ouvrir notre projet:
	1-	Aller sur le projet avec la ligne de command : cd projectName
	2-	Installer les fichier de composer non mis sur le git :  composer install
	3-	Créer une base de données sur phpMyAdmin
	4-	Créer un fichier se nommant .env avec les élément contenu dans .env.example modifié pour qu'ils soient adaptés à notre base de données
	5-	générer une clé : php artisan key:generate
	6-	Migrer les bases de données contenu dans le code, dans la base créer sur phpMyAdmin : php artisan migrate
	
Lien du site en ligne:
	

    Système de gestion utilisateur :
        on peut:
        
        - Créer un compte
        
        - Se connecter avec ses identifiants
        
        - Avoir accès à un espace personnel
        
        - Mettre à jour ses informations personnelles
        
        - Disposer d’une page de profil publique où s’affichent ses récents tweets et retweets dans un
        ordre chronologique
        
        - Un utilisateur peut suive un autre utilisateur pour voir son contenu dans sa timeline
        
    Système de Tweets : 
    
        -L’utilisateur peut écrire des Tweets d’un nombre de caractère limité à 140.
        
        - Les tweets sont visible seulement par les personnes qui suivent la personne qui
        envoie le tweet.
        
        - Une personne peut retweeter un tweet.
        
        - Une personne peut liker le tweet.
        
        - Seul la personne ayant créer le tweet peut le supprimer / modifier.
        
    Système de timeline : 
    
        -L’utilisateur peut voir les tweets écrits par les personne qu’il suit.
        
        - Sur la page d’accueil lorsque l’utilisateur est connecté, il voit les derniers tweets des
        personnes qu’il suit (Dans un ordre chronologique).
        
        - Il peut remonter dans sa timeline pour voir des tweets plus anciens.
        

Bonus Réalisé:

    -Css


Lien du Git:

    git@github.com:perriguigui/TwitterLike.git

Etapes pour ouvrir notre projet:

    1-    Aller sur le projet avec la ligne de command : cd projectName
    
    2-    Installer les fichier de composer non mis sur le git :  composer install
    
    3-    Créer une base de données sur phpMyAdmin
    
    4-    Créer un fichier se nommant .env avec les élément contenu dans .env.example modifié pour qu'ils soient adaptés à notre base de données
    
    5-    générer une clé : php artisan key:generate
    
    6-    Migrer les bases de données contenu dans le code, dans la base créer sur phpMyAdmin : php artisan migrate
    

Lien du site en ligne:
    hatweets.000webhostapp.com

