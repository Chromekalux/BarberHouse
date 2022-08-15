<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'images')]
    private Collection $articles;

    #[ORM\ManyToMany(targetEntity: Catalogue::class, mappedBy: 'images')]
    private Collection $catalogues;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->catalogues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addImage($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeImage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Catalogue>
     */
    public function getCatalogues(): Collection
    {
        return $this->catalogues;
    }

    public function addCatalogue(Catalogue $catalogue): self
    {
        if (!$this->catalogues->contains($catalogue)) {
            $this->catalogues->add($catalogue);
            $catalogue->addImage($this);
        }

        return $this;
    }

    public function removeCatalogue(Catalogue $catalogue): self
    {
        if ($this->catalogues->removeElement($catalogue)) {
            $catalogue->removeImage($this);
        }

        return $this;
    }
}
