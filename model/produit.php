<?php
require_once "model/ConnexionBDD.php";

class Produit{
    private int $id_produit;
    private string $nom_produit;
    private string $taille;
    private string $sexe;
    private string $type_vetement;
    private string $categorie_vetement;
    private float $prix;
    private string $image;

    
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id_produit;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id_produit = $id;

        return $this;
    }

    /**
     * Get the value of nom_produit
     */
    public function getNomProduit(): string
    {
        return $this->nom_produit;
    }

    /**
     * Set the value of nom_produit
     */
    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    /**
     * Get the value of taille
     */
    public function getTaille(): string
    {
        return $this->taille;
    }

    /**
     * Set the value of taille
     */
    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get the value of sexe
     */
    public function getSexe(): string
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     */
    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of type_vetement
     */
    public function getTypeVetement(): string
    {
        return $this->type_vetement;
    }

    /**
     * Set the value of type_vetement
     */
    public function setTypeVetement(string $type_vetement): self
    {
        $this->type_vetement = $type_vetement;

        return $this;
    }

    /**
     * Get the value of categorie_vetement
     */
    public function getCategorieVetement(): string
    {
        return $this->categorie_vetement;
    }

    /**
     * Set the value of categorie_vetement
     */
    public function setCategorieVetement(string $categorie_vetement): self
    {
        $this->categorie_vetement = $categorie_vetement;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     */
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
// Fonctions CRUD

// Recupérer tous les produits
function TouslesProduits() {
    $produits = [];
    $sqlReq = "SELECT * FROM produit";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');
        $produits = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $produits;
    }
}
// Récupérer un produit par son id
function AvoirUnProduitParSonId(int $id){
    $produit = null;
    $sqlReq = "SELECT * FROM produit WHERE id_produit= :id";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $ret = $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        if ($ret) {
            $produit = $req->fetch();
        }
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $produit;
    }
}
// Ajouter un produit
function AjoutProduit(Produit $produit){
    $ret=false;
    $sqlReq = "INSERT INTO produit (nom_produit, taille, sexe, type_vetement, categorie_vetement, prix, image)";
    $sqlReq .= " VALUES(:nom_produit, :taille, :sexe, :type_vetement, :categorie_vetement, :prix, :image)";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':nom_produit', $produit->getNomProduit(), PDO::PARAM_STR);
        $req->bindValue(':taille', $produit->getTaille(), PDO::PARAM_STR);
        $req->bindValue(':sexe', $produit->getSexe(), PDO::PARAM_STR);
        $req->bindValue(':type_vetement', $produit->getTypeVetement(), PDO::PARAM_STR);
        $req->bindValue(':categorie_vetement', $produit->getCategorieVetement(), PDO::PARAM_STR);
        $req->bindValue(':prix', $produit->getPrix());
        $req->bindValue(':image', $produit->getImage(), PDO::PARAM_STR);

        $ret = $req->execute();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }finally{
        return $ret;
    }
}

// Recuperer les produits par sexe
// Produits pour les Femmes
function RecupererProduitFemme():array {
    $produitFemme = [];
    $sqlReq = "SELECT * FROM produit WHERE sexe= 'femme'";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');
        $produitFemme = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $produitFemme;
    }
}
// Produits pour les Hommes
function RecupererProduitHomme() {
    $produitHomme = [];
    $sqlReq = "SELECT * FROM produit WHERE sexe= 'homme'";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');
        $produitHomme = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $produitHomme;
    }
}
// Produits pour les Enfants
function RecupererProduitEnfants() {
    $produitEnfants = [];
    $sqlReq = "SELECT * FROM produit WHERE sexe= 'enfant'";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');
        $produitEnfants = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $produitEnfants;
    }
}
