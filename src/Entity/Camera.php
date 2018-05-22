<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camera
 *
 * @ORM\Table(name="camera")
 * @ORM\Entity(repositoryClass="App\Repository\CameraRepository")
 */
class Camera
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, unique=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="proxy_link", type="string", length=255, nullable=true)
     */
    private $proxy_link;

    /**
     * @var int
     *
     * @ORM\Column(name="process_id", type="integer", nullable=true)
     */
    private $process_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cameras")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="camera")
     */
    private $files;

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return Camera
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Camera
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set link.
     *
     * @param string $link
     *
     * @return Camera
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set proxy_link.
     *
     * @param string $proxy_link
     *
     * @return Camera
     */
    public function setProxyLink($proxy_link)
    {
        $this->proxy_link = $proxy_link;

        return $this;
    }

    /**
     * Get proxy_link.
     *
     * @return string
     */
    public function getProxyLink()
    {
        return $this->proxy_link;
    }

    /**
     * Set process_id.
     *
     * @param int $process_id
     *
     * @return Camera
     */
    public function setProcessId(int $process_id)
    {
        $this->process_id = $process_id;
        return $this;
    }

    /**
     * Get process_id.
     *
     * @return int
     */
    public function getProcessId()
    {
        return $this->process_id;
    }

    /**
     * Get User.
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set User.
     *
     * @param string $link
     *
     * @return Camera
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Files[]
     */
    public function getFiles()
    {
        return $this->files;
    }

}