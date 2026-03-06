<?php

require_once "model/ConnexionBDD.php";

class Commande {
    private int $id_commande;
    private string $reference;
    private float $montant;
    private DateTime $date;
    private int $id_utilisateur;

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
     * Get the value of reference
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Set the value of reference
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the value of montant
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     */
    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

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

// Création d'une commande 
function creationCommande(Commande $commande): int {
    $ret = false;
    $dernierId = 0;

    $sqlReq = "INSERT INTO commande (reference, montant, date, id_utilisateur)";
    $sqlReq .= " VALUES(:reference, :montant, :date, :utilisateur)";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':reference', $commande->getReference(), PDO::PARAM_STR);
        $req->bindValue(':montant', $commande->getMontant());
        $req->bindValue(':date', $commande->getDate()->format("Y-m-d H:i:s"));
        $req->bindValue(':utilisateur', $commande->getIdUtilisateur());

        $ret = $req->execute();
        if ($ret) {
            $dernierId = intval($ctxBDD->lastInsertId());
        }
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        // id de la commande que l'on vient de créer
        return $dernierId;
    }
}

// Nombre de commande
function NbCommandes(): int {
    $nbcommande = 0;

    $sqlReq = "SELECT COUNT(id_commande) as nb_commandes FROM commande GROUP BY id_commande";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);
        $retNb = $req->fetch();

        if(!$retNb) {
            $nbcommande = 0;
        }
        else {
            $nbcommande = $retNb['nb_commandes'];
        }

    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $nbcommande;
    }

}

// Récupérer une commande par son id
function RecupererUneCommandeParId(int $idCommande) {

    $sqlReq = "SELECT * FROM commande WHERE id_commande = :id_commande";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_commande', $idCommande, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $commande = new Commande();
        $commande->setIdCommande($data['id_commande']);
        $commande->setReference($data['reference']);
        $commande->setMontant($data['montant']);
        $commande->setDate(new DateTime($data['date']));
        $commande->setIdUtilisateur($data['id_utilisateur']);

        return $commande;

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
        return null;
    }
}

// Récupérer toutes les commandes d'un utilisateur
function RecupererCommandeParUtilisateur(int $idUtilisateur): array {
    $commandes = [];

    $sqlReq = "SELECT * FROM commande WHERE id_utilisateur = :id_utilisateur ORDER BY date DESC"; // On récupère les commandes et on les tri de la plus récente 
                                                                                                 // a la plus ancienne
    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);

        $req->bindValue(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
        $req->execute();

        $dateCommandes = $req->fetchAll(PDO::FETCH_ASSOC); // récupère d'abord en tableau associatif

        foreach ($dateCommandes as $date) {
            $commande = new Commande();
            $commande->setIdCommande($date['id_commande']);
            $commande->setReference($date['reference']);
            $commande->setMontant($date['montant']);
            $commande->setDate(new DateTime($date['date'])); // transforme la string en DateTime
            $commande->setIdUtilisateur($date['id_utilisateur']);

            $commandes[] = $commande;
        }

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    
    return $commandes;
    
}