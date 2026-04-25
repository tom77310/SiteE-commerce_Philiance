<?php
require_once "model/ConnexionBDD.php";

class Avis{
    private int $id_avis;
    private int $id_utilisateur;
    private int $id_produit;
    private int $note;
    private string $commentaire;
    private string $date;
    

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
     * Get the value of id_produit
     */
    public function getIdProduit(): int
    {
        return $this->id_produit;
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
    /**
     * Set the value of id_produit
     */
    public function setIdProduit(int $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    /**
     * Get the value of note
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * Set the value of note
     */
    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
    
    /**
     * Get the value of commentaire
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     */
    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(string $date): self
    {
        $this->date = $date;

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
function AjoutAvis(int $idUtilisateur, int $idProduit, int $note, string $commentaire): bool{
    // $ret = false;
    $sqlReq = "INSERT INTO avis (id_utilisateur, id_produit, note, commentaire)";
    $sqlReq .= " VALUES(:utilisateur, :produit, :note, :commentaire)";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':utilisateur', $idUtilisateur);
        $req->bindValue(':produit', $idProduit);
        $req->bindValue(':note', $note);
        $req->bindValue(':commentaire', $commentaire);

        $ret = $req->execute();

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return false;
    }
}
// Fonction pour verifier si un avis existe deja et pour bloquer plusieurs avis d'un meme utilisateur sur le meme produit
function AvisExisteDeja(int $idUtilisateur, int $idProduit): bool {
    $sql = "SELECT COUNT(*) as nb
            FROM avis
            WHERE id_utilisateur = :user
            AND id_produit = :produit";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sql);
        $req->bindValue(':user', $idUtilisateur, PDO::PARAM_INT);
        $req->bindValue(':produit', $idProduit, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['nb'] > 0;

    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
// Récupéter un avis en fonction du produit
function AvoirAvisParProduit(int $idProduit): array {
    $avis = [];
    $sqlReq = "SELECT a.*, u.pseudo
                FROM avis a
                JOIN utilisateurs u ON a.id_utilisateur = u.id_utilisateurs
                WHERE a.id_produit = :id
                ORDER BY a.date DESC";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id', $idProduit);
        $req->execute();

        $avis = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $avis;
    }
}

// supprimer un avis
function SupprimerAvisParId(int $idAvis): bool {

    $sqlReq = "DELETE FROM avis WHERE id_avis = :id_avis";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_avis', $idAvis, PDO::PARAM_INT);
        return $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        return false;
    }
}


// Modifier un avis par son id
function ModifierAvis(int $idAvis,int $note, string $commentaire): bool {

    $sqlReq = "UPDATE avis 
               SET note = :note, commentaire = :commentaire
               WHERE id_avis = :id_avis";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':note', $note, PDO::PARAM_INT);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':id_avis', $idAvis, PDO::PARAM_INT);

        return $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        return false;
    }
}
// Avoir un avis par son id
function AvoirAvisParId(int $idAvis) {
    $sql = "SELECT * FROM avis WHERE id_avis = :id";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sql);
        $req->bindValue(':id', $idAvis, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;

    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

// Avoir l'avis par l'utilisateur
function AvoirAvisParUtilisateur(int $idUtilisateur): array {
    $avis = [];
    $sqlReq = "SELECT a.*, p.nom_produit
                FROM avis a
                JOIN produit p ON a.id_produit = p.id_produit
                WHERE a.id_utilisateur = :id_utilisateur
                ORDER BY a.date DESC";
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
        $req->execute();

        $avis = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    return $avis;
}