<?php

require_once "model/ConnexionBDD.php";
require_once "model/produit.php";

class detailCommande {
    private int $id_detail_commande;
    private int $id_commande;
    private int $id_produit;
    private int $quantite;
    private float $prix_unitaire;

    /**
     * Get the value of id_detail_commande
     */
    public function getIdDetailCommande(): int
    {
        return $this->id_detail_commande;
    }

    /**
     * Set the value of id_detail_commande
     */
    public function setIdDetailCommande(int $id_detail_commande): self
    {
        $this->id_detail_commande = $id_detail_commande;

        return $this;
    }

    /**
     * Get the value of id_commande
     */
    public function getIdCommande(): int
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     */
    public function setIdCommande(int $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    /**
     * Get the value of id_produit
     */
    public function getIdProduit(): int
    {
        return $this->id_produit;
    }

    /**
     * Set the value of id_produit
     */
    public function setIdProduit(int $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    /**
     * Get the value of quantite
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     */
    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix_unitaire
     */
    public function getPrixUnitaire(): float
    {
        return $this->prix_unitaire;
    }

    /**
     * Set the value of prix_unitaire
     */
    public function setPrixUnitaire(float $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }
}

// Ajouter un produit dans une commande

function AjouterDetailCommande(detailCommande $detail): bool {
    $ret = false;
    $sqlReq = "INSERT INTO detail_commande (id_commande, id_produit, quantite, prix_unitaire)
                VALUES (:id_commande, :id_produit, :quantite, :prix_unitaire)";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        
        $req->bindValue('id_commande', $detail->getIdCommande(), PDO::PARAM_INT);
        $req->bindValue('id_produit', $detail->getIdProduit(), PDO::PARAM_INT);
        $req->bindValue(':quantite', $detail->getQuantite(), PDO::PARAM_INT);
        $req->bindValue('prix_unitaire', $detail->getPrixUnitaire());

        $ret = $req->execute();

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}

// Récupérer les détail de la commande

function RecupererDetailsCommande(int $idCommande):array {
    $details = [];
    $sqlReq = "SELECT * FROM detail_commande WHERE id_commande = :id_commande";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_commande', $idCommande, PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS, 'detailCommande'); // detailCommande => nom du model
        $details = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally{
        return $details;
    }
}