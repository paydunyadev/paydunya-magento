package com.groupeisi.isihelp.domain;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;

import javax.persistence.*;

import java.io.Serializable;
import java.time.LocalDate;
import java.util.HashSet;
import java.util.Set;

/**
 * A Question.
 */
@Entity
@Table(name = "question")
public class Question implements Serializable {

    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "libelle")
    private String libelle;

    @Column(name = "date")
    private LocalDate date;

    @Column(name = "cloturer")
    private Boolean cloturer;

    @OneToMany(mappedBy = "question")
    private Set<Commentaire> commentaires = new HashSet<>();

    @ManyToOne
    @JsonIgnoreProperties(value = "questions", allowSetters = true)
    private Techno techno;

    @ManyToOne
    @JsonIgnoreProperties(value = "questions", allowSetters = true)
    private Langage langage;

    // jhipster-needle-entity-add-field - JHipster will add fields here
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getLibelle() {
        return libelle;
    }

    public Question libelle(String libelle) {
        this.libelle = libelle;
        return this;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public LocalDate getDate() {
        return date;
    }

    public Question date(LocalDate date) {
        this.date = date;
        return this;
    }

    public void setDate(LocalDate date) {
        this.date = date;
    }

    public Boolean isCloturer() {
        return cloturer;
    }

    public Question cloturer(Boolean cloturer) {
        this.cloturer = cloturer;
        return this;
    }

    public void setCloturer(Boolean cloturer) {
        this.cloturer = cloturer;
    }

    public Set<Commentaire> getCommentaires() {
        return commentaires;
    }

    public Question commentaires(Set<Commentaire> commentaires) {
        this.commentaires = commentaires;
        return this;
    }

    public Question addCommentaire(Commentaire commentaire) {
        this.commentaires.add(commentaire);
        commentaire.setQuestion(this);
        return this;
    }

    public Question removeCommentaire(Commentaire commentaire) {
        this.commentaires.remove(commentaire);
        commentaire.setQuestion(null);
        return this;
    }

    public void setCommentaires(Set<Commentaire> commentaires) {
        this.commentaires = commentaires;
    }

    public Techno getTechno() {
        return techno;
    }

    public Question techno(Techno techno) {
        this.techno = techno;
        return this;
    }

    public void setTechno(Techno techno) {
        this.techno = techno;
    }

    public Langage getLangage() {
        return langage;
    }

    public Question langage(Langage langage) {
        this.langage = langage;
        return this;
    }

    public void setLangage(Langage langage) {
        this.langage = langage;
    }
    // jhipster-needle-entity-add-getters-setters - JHipster will add getters and setters here

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof Question)) {
            return false;
        }
        return id != null && id.equals(((Question) o).id);
    }

    @Override
    public int hashCode() {
        return 31;
    }

    // prettier-ignore
    @Override
    public String toString() {
        return "Question{" +
            "id=" + getId() +
            ", libelle='" + getLibelle() + "'" +
            ", date='" + getDate() + "'" +
            ", cloturer='" + isCloturer() + "'" +
            "}";
    }
}
