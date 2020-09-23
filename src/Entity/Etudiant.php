<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $Prenom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_De_Naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $Code_postal;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="etudiant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="etudiant")
     */
    private $Demande;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Diplomes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Domaine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "L'adresse e-mail entrée n'est pas valide"
     * )
     */
    private $email;

    public function __construct()
    {
        $this->Demande = new ArrayCollection();
        $this->Date_De_Naissance = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->Date_De_Naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $Date_De_Naissance): self
    {
        $this->Date_De_Naissance = $Date_De_Naissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->Code_postal;
    }

    public function setCodePostal(string $Code_postal): self
    {
        $this->Code_postal = $Code_postal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemande(): Collection
    {
        return $this->Demande;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->Demande->contains($demande)) {
            $this->Demande[] = $demande;
            $demande->setEtudiant($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->Demande->contains($demande)) {
            $this->Demande->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getEtudiant() === $this) {
                $demande->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDiplomes(): ?string
    {
        return $this->Diplomes;
    }

    public function setDiplomes(string $Diplomes): self
    {
        $this->Diplomes = $Diplomes;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->Domaine;
    }

    public function setDomaine(string $Domaine): self
    {
        $this->Domaine = $Domaine;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(?string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
