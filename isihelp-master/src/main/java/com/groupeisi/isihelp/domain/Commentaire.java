package com.groupeisi.isihelp.domain;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;

import javax.persistence.*;

import java.io.Serializable;
import java.time.LocalDate;

/**
 * A Commentaire.
 */
@Entity
@Table(name = "commentaire")
public class Commentaire implements Serializable {

    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "libelle")
    private String libelle;

    @Column(name = "date")
    private LocalDate date;

    @Column(name = "vote")
    private Integer vote;

    @ManyToOne
    @JsonIgnoreProperties(value = "commentaires", allowSetters = true)
    private Question question;

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

    public Commentaire libelle(String libelle) {
        this.libelle = libelle;
        return this;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public LocalDate getDate() {
        return date;
    }

    public Commentaire date(LocalDate date) {
        this.date = date;
        return this;
    }

    public void setDate(LocalDate date) {
        this.date = date;
    }

    public Integer getVote() {
        return vote;
    }

    public Commentaire vote(Integer vote) {
        this.vote = vote;
        return this;
    }

    public void setVote(Integer vote) {
        this.vote = vote;
    }

    public Question getQuestion() {
        return question;
    }

    public Commentaire question(Question question) {
        this.question = question;
        return this;
    }

    public void setQuestion(Question question) {
        this.question = question;
    }
    // jhipster-needle-entity-add-getters-setters - JHipster will add getters and setters here

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof Commentaire)) {
            return false;
        }
        return id != null && id.equals(((Commentaire) o).id);
    }

    @Override
    public int hashCode() {
        return 31;
    }

    // prettier-ignore
    @Override
    public String toString() {
        return "Commentaire{" +
            "id=" + getId() +
            ", libelle='" + getLibelle() + "'" +
            ", date='" + getDate() + "'" +
            ", vote=" + getVote() +
            "}";
    }
}
