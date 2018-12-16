# Theorie

## 1) Injection de dépendance
*1 point pour donner les noms de fichiers et les lignes de ces fichiers dans lesquelles un mécanisme d'inversion de dépendance est à l'oeuvre.*

## 2) Diagramme de classe
*2 points pour un diagramme de classe incluant les classes et interfaces que vous avez créé ainsi que celles dont vous dépendez*

## 3) Argumentaire "héritage vs compositions" : 

*2 points pour un court argumentaire sur le thème "héritage vs composition", avantage et inconvénient de chaque (un travail de recherche court est donc à effectuer, "Composition over inheritance" en anglais). Le texte fourni doit faire 500 mots.*

Lorsque l'on souhaite mettre en communs du code afin d'éviter de la redondance, on peut avoir recours à plusieurs principe de programmations.
Ceux que je souhaite aborder aujourd'hui sont l'héritage et la composition.

### L'héritage

L'héritage est le principe de créer une nouvelle classe à partir d'une classe existante en lui rajoutant des comportements.
L'avantage de ce principe est de ne pas repartir de zéro pour créer la nouvelle classe : on peut reprendre les comportements de la classe existante en l'étendant.

Prenons un exemple simple : Une classe **Point** ayant comme comportement de pouvoir **afficher ses coordonnées** :
```
class Point
{
    private x; /* int */
    private y; /* int */

    public __construct( int x, int y) {
        $this->x = x;
        $this->y = y;
    }

    public getX(){
        return $this->x;
    }

    public getY(){
        return $this->y;
    }

    public function sayPosition() {
        echo "Position(X: {$this->getX()}, Y: {$this->getY()})";
    }
}
```
On souhaite créer une classe **Rectangle**. Elle peut elle aussi afficher ses coordonnées mais elle peut également afficher sa taille.
Dans une première approche on peut utiliser l'héritage : la classe **Rectangle** peut hériter de la classe **Point** et définir le comportement **afficher sa taille** :
```
class Rectangle extends Point
{
    private width;  /* int */
    private height; /* int */

    public __construct( int x, int y, int width, int height) {
        $this->x = x;
        $this->y = y;
        $this->width = width;
        $this->height = height;  
    }

    public getWidth(){
        return $this->width;
    }

    public getHeight(){
        return $this->height;
    }

    public function saySize() {
        echo "Size(Width: {$this->getWidth()}, Height: {$this->getHeight()})";
    }
}
```
On peut voir dans cet exemple que l'héritage permet de coder plus rapidement la classe **Rectangle** au détriment de sa lisibilité : 
En regardant uniquement la classe **Rectangle** on ne peut pas savoir qu'elle possède le comportement **donner ses coordonnées**.
L'héritage lie fortement la classe **Rectangle** à la classe **Point**. Si on change l'implémentation de la classe **Point** il faudra mettre à jour la **Rectangle**.
La composition peut permettre de résoudre ce problème.

### La compostion

Dans une autre approche on peut utiliser la composition.

La composition est le principe de considérer qu'un objet est un ensemble de composants. Si on détruit l'objet, les composants sont détruits.
L'avantage de ce principe est de ne pas dépendre de l'implémentation des classes de composants. On utilise uniquement les comportements / méthodes à dispositions.

Si on reprend notre classe **Rectangle**, on peut la voir comme un **ensemble** de 2 points : le coin supérieur gauche et le coin inférieur droit
```
class Rectangle
{
    private points; /* Array  */

    public __construct( Point topLeftCorner, Point bottomRightCorner) {

        $this->points = [topLeftCorner, bottomRightCorner];
    }

    public getX() {
        return points[0]->getX();
    }

    public getY() {
        return points[0]->getY();
    }

    public getWidth(){
        return ($this->points[1]->getX() - $this->points[0]->getX());
    }

    public getHeight(){
        return ($this->points[1]->getY() - $this->points[0]->getY());
    }

    public function sayPosition() {
        echo "Position(X: {$this->getX()}, Y: {$this->getY()})";
    }

    public function saySize() {
        echo "Size(Width: {$this->getWidth()}, Height: {$this->getHeight()})";
    }
}
```
On peut voir dans cet exemple que l'héritage permet de coder plus rapidement la classe **Rectangle** au détriment de sa lisibilité : 
En regardant uniquement la classe **Rectangle** on ne peut pas savoir qu'elle possède le comportement **donner ses coordonnées**.
L'héritage lie fortement la classe **Rectangle** à la classe **Point**. Si on change l'implémentation de la classe **Point** il faudra mettre à jour la **Rectangle**.
La composition peut permettre de résoudre ce problème.

On peut voir dans cet exemple que la composition permet de ne pas lié fortement la classe **Rectangle** à la class **Point**. 
Une modification de l'implémentation de la classe **Point** ne nécessitera aucun changement dans la classe **Rectangle**.
La classe **Rectangle** est plus longue mais gagne ainsi en lisibilité : on voit tous ses comportements dans son code.

Si on souhaite faire adopter un nouveau comportement à notre classe, il suffit d'y rajouter un autre composants.
La composition est ainsi plus modulable que l'héritage.