<?php
require_once "model/ConnexionBDD.php";

class Avis{
    private int $id_avis;
    private string $pseudo;
    private string $date_avis;
    private int $id_produit;
    private string $description;
    private int $id_utilisateur;

    

    /**
     * Get the value of id_avis
     */
    public function getIdAvis(): int
    {
        return $this->id_avis;
    }

    /**
     * Set the value of id_avis
     */
    public function setIdAvis(int $id_avis): self
    {
        $this->id_avis = $id_avis;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of date_avis
     */
    public function getDateAvis(): string
    {
        return $this->date_avis;
    }

    /**
     * Set the value of date_avis
     */
    public function setDateAvis(string $date_avis): self
    {
        $this->date_avis = $date_avis;

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
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     */
    public function setIdUtilisateur(int $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}

// CRUD
// Récuperer tous les avis
function TousLesAvis():array{
    $avis = [];
    $sqlReq = "SELECT * FROM avis";
    
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);

        $req->setFetchMode(PDO::FETCH_CLASS, 'Avis');
        $avis = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }finally{
        return $avis;
    }
}
// Ajouter un avis
function AjoutAvis(Avis $avis): bool{
    $ret = false;
    $sqlReq = "INSERT INTO avis (pseudo, date_avis, id_produit, description, id_utilisateur)";
    $sqlReq .= " VALUES(:pseudo, :date_avis, :produit, :description, :utilisateur)";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':pseudo', $avis->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':date_avis', $avis->getDateAvis(), PDO::PARAM_STR);
        $req->bindValue(':produit', $avis->getIdProduit());
        $req->bindValue(':description', $avis->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':utilisateur', $avis->getIdUtilisateur());

        $ret = $req->execute();

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}
// Récupéter un avis en fonction du produit
function AvoirAvisParProduit(int $id_produit): array {
    $avis = [];
    $sqlReq = "SELECT * FROM avis WHERE id_produit = :id_produit";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Avis');
        $req->execute();
        $avis = $req->fetchAll();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $avis;
    }
}

// supprimer un avis
function SupprimerAvisParId(int $id_avis): bool {
    $ret = false;
    $sqlReq = "DELETE FROM avis WHERE id_avis = :id_avis";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_avis', $id_avis, PDO::PARAM_INT);
        $ret = $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}


// Modifier un avis par son id
function ModifierAvis(int $id_avis,string $nouveauPseudo,string $nouvelleDescription,string $nouvelleDateAvis): bool {
    $ret = false;

    $sqlReq = "UPDATE avis 
               SET pseudo = :pseudo,
                   description = :description,
                   date_avis = :date_avis
               WHERE id_avis = :id_avis";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':pseudo', $nouveauPseudo, PDO::PARAM_STR);
        $req->bindValue(':description', $nouvelleDescription, PDO::PARAM_STR);
        $req->bindValue(':date_avis', $nouvelleDateAvis, PDO::PARAM_STR);
        $req->bindValue(':id_avis', $id_avis, PDO::PARAM_INT);

        $ret = $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}
