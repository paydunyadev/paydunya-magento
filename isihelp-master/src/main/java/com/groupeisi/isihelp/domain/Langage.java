package com.groupeisi.isihelp.domain;


import javax.persistence.*;

import java.io.Serializable;
import java.util.HashSet;
import java.util.Set;

/**
 * A Langage.
 */
@Entity
@Table(name = "langage")
public class Langage implements Serializable {

    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "libelle")
    private String libelle;

    @Column(name = "publish")
    private Boolean publish;

    @OneToMany(mappedBy = "langage")
    private Set<Question> questions = new HashSet<>();

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

    public Langage libelle(String libelle) {
        this.libelle = libelle;
        return this;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public Boolean isPublish() {
        return publish;
    }

    public Langage publish(Boolean publish) {
        this.publish = publish;
        return this;
    }

    public void setPublish(Boolean publish) {
        this.publish = publish;
    }

    public Set<Question> getQuestions() {
        return questions;
    }

    public Langage questions(Set<Question> questions) {
        this.questions = questions;
        return this;
    }

    public Langage addQuestion(Question question) {
        this.questions.add(question);
        question.setLangage(this);
        return this;
    }

    public Langage removeQuestion(Question question) {
        this.questions.remove(question);
        question.setLangage(null);
        return this;
    }

    public void setQuestions(Set<Question> questions) {
        this.questions = questions;
    }
    // jhipster-needle-entity-add-getters-setters - JHipster will add getters and setters here

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof Langage)) {
            return false;
        }
        return id != null && id.equals(((Langage) o).id);
    }

    @Override
    public int hashCode() {
        return 31;
    }

    // prettier-ignore
    @Override
    public String toString() {
        return "Langage{" +
            "id=" + getId() +
            ", libelle='" + getLibelle() + "'" +
            ", publish='" + isPublish() + "'" +
            "}";
    }
}
