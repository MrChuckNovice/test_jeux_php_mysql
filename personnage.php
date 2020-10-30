<?php
class Personnage // Présence du mot-clé class suivi du nom de la classe.
{
    // Déclaration ds attributs et méthodes ici.
    private $_force= 20;  // la force du personnage, par défaut à 50.
    private $_experience=0;  // son expérience, par défaut à 1.
    private $_degats=0;    // ses dégats, par défaut à 0.

    public function deplacer() // Une méthode qui déplacera le personnage (modifiera sa localisation).
    {

    }

    public function frapper($persoAFrapper) // UNe méthode qui frappera un personnage (suivant la force qu'il a).
    {
      $persoAFrapper->_degats += $this->_force;
    }
    public function afficherExperience()
    {
        echo $this->_experience;
    }

    public function gagnerExperience() // Une méthode augmentant l'attribut $_experience du personnage.
    {
         // Ceci est un raccourci qui équivaut à écrire « $this->_experience = $this->_experience + 1 »
         // On aurait aussi pu écrire « $this->_experience += 1 »
          $this->_experience++;
    }

    // Déclaration des constantes en rapport avec la force.

    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;

    // Variable statique PRIVEE. 
    private static $_texteADire = ' Alea Jacta est';

    public function __construct($forceInitiale) // Constructeur demandant 2 paramètres
    {
       echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.
       // N'oubliez pas qu'il faut assigner la valeur d'un attribut uniquement depuis son setter ! 
       $this->setForce($forceInitiale);
    }

    // Mutateur(setters) charger de modifier l'attribut $_force.
    public function setForce($force)
    {
         // On vérifie qu'on nous donne bien soit une << FORCE_PETITE >>, soit une << FORCE_MOYENNE >>, soit une << FORCE_GRANDE >>. 
        if (!in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE])) 
        {$this->_force=$force;
        }
    }
         // Notez que le mot-clé static peut être placé avant la visibilité de la méthode .
         public static function parler()
    {
        echo self::$_texteADire; //on donne le texte à dire.
    }

    // Mutateur(setters) charger de modifier l'attribut $_degats.
    public function setDegats($degats)
    {
        if (!is_int($degats)) // s'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('Le niveau de dégâts d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        $this->_degats=$degats;
    }

    // Mutateurs(Setters) charger de modifier l'attribut $_experience.
    public function setExperience($experience)
    {
        if (!is_int($experience)) // S'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if ($experience > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieur à 100.
        {
            trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_experience=$experience;
    }

    // Ceci est la méthode force() : elle se charge de renvoyer le contenu de l'attribut $_degats.
    public function degats()
    {
        return $this->_degats;
    }

    // Ceci est la méthode() : elle se charge de renvoyer le contenu de l'attribut $_force.
    public function force ()
    {
        return $this->_force;
    }
    // Ceci est la méthode expérience() : elle se charge de renvoyer le contenu de  l'attribut $_experience.
    public function experience()
    {
        return $this->_experience;
    }
}
$perso = new Personnage(Personnage::FORCE_MOYENNE); // premier Personnage
$perso2 =new Personnage(Personnage::FORCE_PETITE); // second Personnage

$perso->setForce(10);
$perso->setExperience(2);

$perso2->setForce(90);
$perso2->setExperience(58);

$perso->frapper($perso2); // $perso frappe $perso2
$perso->gagnerExperience();  // On gagne de l'experience.


$perso2->frapper($perso); // $perso2 frappe $perso
$perso2->gagnerExperience();  // On gagne de l'experience.


echo 'Le personnage 1 a ', $perso->force(), ' de force, contrairement au personnage 2 qui a ', $perso2->force(), ' de force.<br />';
echo 'Le personage 1 a ', $perso->degats(), ' de dégâts, contrairemant au personnage 2 qui a ', $perso2->degats(), ' de dégâts.<br />';
?>