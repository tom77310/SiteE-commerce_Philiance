<?php
require_once "model/ConnexionBDD.php";

class Utilisateurs {
    private int $id_utilisateurs;
    private string $nom;
    private string $prenom;
    private string $pseudo;
    private string $tel;
    private string $date_naissance;
    private string $email;
    private string $motdepasse;
    private string $role;

    /**
     * Get the value of id_client
     */
    public function getIdUtilisateurs(): int
    {
        return $this->id_utilisateurs;
    }

    /**
     * Set the value of id_client
     */
    public function setIdUtilisateurs(int $id_utilisateurs): self
    {
        $this->id_utilisateurs = $id_utilisateurs;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
     * Get the value of tel
     */
    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     */
    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of date_naissance
     */
    public function getDateNaissance(): string
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of date_naissance
     */
    public function setDateNaissance(string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of motdepasse
     */
    public function getMotdepasse(): string
    {
        return $this->motdepasse;
    }

    /**
     * Set the value of motdepasse
     */
    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    // Hash du mot de passe
    public function encryptPasswd($clearMdp) {
        $this->motdepasse = password_hash($clearMdp, PASSWORD_DEFAULT);
        return $this->motdepasse;
    }

    // Vérification du mot de passe
    public function checkPasswd(string $clearMdp):bool {
        return password_verify($clearMdp, $this->motdepasse);
    }
}

// CRUD
// Récupérer tous les utilisateurs
function TousLesUtilisateurs():array {
    $utilisateurs = [];
    $sqlReq = "SELECT * FROM utilisateurs";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->query($sqlReq);

        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $utilisateurs = $req->fetchAll();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }finally{
        return $utilisateurs;
    }
}

// Récupérer un utilisateur spécifique par son id
function AvoirUtilisateurParSonId(int $id_utilisateurs): Utilisateurs {
    $utilisateur = null;
    $sqlReq = "SELECT * FROM utilisateurs WHERE id_utilisateurs=:id_utilisateurs";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $ret = $req->execute();

        if ($ret){
            $utilisateur = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump ($ex->getMessage());
    }
    finally {
        return $utilisateur;
    }
}

// Récupérer un utilisateur avec son Email
function AvoirUtilisateurParSonEmail(string $email): Utilisateurs | false {
    $utilisateur = null;
    $sqlReq = "SELECT * FROM utilisateurs WHERE email=:email";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $ret = $req->execute();

        if ($ret){
            $utilisateur = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump ($ex->getMessage());
    }
    finally {
        return $utilisateur;
    }
}

// Ajouter un utilisateur
function AjoutUtilisateur(Utilisateurs $utilisateur): bool {
    $ret = false;
    $sqlReq = "INSERT INTO utilisateurs (nom, prenom, pseudo, tel, date_naissance, email, motdepasse, role)";
    $sqlReq .= " VALUES(:nom, :prenom, :pseudo, :tel, :date_naissance, :email, :motdepasse, :role)";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':pseudo', $utilisateur->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':tel', $utilisateur->getTel(), PDO::PARAM_STR);
        $req->bindValue(':date_naissance', $utilisateur->getDateNaissance(), PDO::PARAM_STR);
        $req->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':role', $utilisateur->getRole(), PDO::PARAM_STR);

        // Hash du mot de passe avant l'écriture en BDD
        $hashPassword = $utilisateur->encryptPasswd($utilisateur->getMotdepasse());
        $req->bindValue(':motdepasse', $hashPassword, PDO::PARAM_STR);

        $ret = $req->execute();
    }

    catch (Exception $ex) {
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}


// Changer le role de l'utilisateur
function ChangerRoleUtilisateur(int $id_utilisateurs, string $nouveauRole): bool {
    $ret = false;

    $sqlReq = "UPDATE utilisateurs SET role = :role WHERE id_utilisateurs = :id_utilisateurs";

    try {
        $ctxBDD =  ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':role', $nouveauRole, PDO::PARAM_STR);
        $req->bindValue(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
        $ret = $req->execute();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $ret;
    }
}

// Supprimer un utilisateur par son id
function SupprimerUtilisateurParId(int $id_utilisateurs):bool {
    $sqlReq = "DELETE FROM utilisateurs WHERE id_utilisateurs=:id_utilisateurs";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $ret = $req->execute();

    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }finally{
        return $ret;
    }
}

// Modifier toutes les infos utilisateurs par rapport a l'id
function modifierUtilisateurComplet(int $id_utilisateurs, string $Nouveaunom, string $Nouveauprenom, string $Nouveaupseudo, string $Nouveautel, string $Nouvelledate_naissance, string $Nouvelemail):bool {
    $ret = false;
    $sqlReq = "UPDATE utilisateurs SET nom=:nom, prenom=:prenom, pseudo= :pseudo, tel=:tel, date_naissance=:date_naissance, email=:email WHERE id_utilisateurs = :id_utilisateurs";

    try {
        $ctxBDD = ConnexionBDD();
        $req = $ctxBDD->prepare($sqlReq);
        $req->bindValue(':nom', $Nouveaunom, PDO::PARAM_STR);
        $req->bindValue(':prenom', $Nouveauprenom, PDO::PARAM_STR);
        $req->bindValue(':pseudo', $Nouveaupseudo, PDO::PARAM_STR);
        $req->bindValue(':tel', $Nouveautel, PDO::PARAM_STR);
        $req->bindValue(':date_naissance', $Nouvelledate_naissance, PDO::PARAM_STR);
        $req->bindValue(':email', $Nouvelemail, PDO::PARAM_STR);
        $req->bindValue(':id_utilisateurs', $id_utilisateurs, PDO::PARAM_INT);
        $ret = $req->execute();
    } catch (Exception $ex) {
        var_dump($ex->getMessage());
    }finally{
        return $ret;
    }


}