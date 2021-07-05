package com.okta.developer.blog.domain;


import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import org.hibernate.annotations.Cache;
import org.hibernate.annotations.CacheConcurrencyStrategy;

import javax.persistence.*;
import javax.validation.constraints.*;

import java.io.Serializable;
import java.util.Objects;

/**
 * A Demande.
 */
@Entity
@Table(name = "demande")
@Cache(usage = CacheConcurrencyStrategy.NONSTRICT_READ_WRITE)
public class Demande implements Serializable {

    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.SEQUENCE, generator = "sequenceGenerator")
    @SequenceGenerator(name = "sequenceGenerator")
    private Long id;

    @NotNull
    @Size(min = 3)
    @Column(name = "last_name", nullable = false)
    private String lastName;

    @NotNull
    @Size(min = 2)
    @Column(name = "first_name", nullable = false)
    private String firstName;

    @Lob
    @Column(name = "image_piece")
    private byte[] imagePiece;

    @Column(name = "image_piece_content_type")
    private String imagePieceContentType;

    @ManyToOne
    @JsonIgnoreProperties("demandes")
    private User user;

    @ManyToOne
    @JsonIgnoreProperties("demandes")
    private Type type;

    // jhipster-needle-entity-add-field - JHipster will add fields here, do not remove
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getLastName() {
        return lastName;
    }

    public Demande lastName(String lastName) {
        this.lastName = lastName;
        return this;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getFirstName() {
        return firstName;
    }

    public Demande firstName(String firstName) {
        this.firstName = firstName;
        return this;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public byte[] getImagePiece() {
        return imagePiece;
    }

    public Demande imagePiece(byte[] imagePiece) {
        this.imagePiece = imagePiece;
        return this;
    }

    public void setImagePiece(byte[] imagePiece) {
        this.imagePiece = imagePiece;
    }

    public String getImagePieceContentType() {
        return imagePieceContentType;
    }

    public Demande imagePieceContentType(String imagePieceContentType) {
        this.imagePieceContentType = imagePieceContentType;
        return this;
    }

    public void setImagePieceContentType(String imagePieceContentType) {
        this.imagePieceContentType = imagePieceContentType;
    }

    public User getUser() {
        return user;
    }

    public Demande user(User user) {
        this.user = user;
        return this;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public Type getType() {
        return type;
    }

    public Demande type(Type type) {
        this.type = type;
        return this;
    }

    public void setType(Type type) {
        this.type = type;
    }
    // jhipster-needle-entity-add-getters-setters - JHipster will add getters and setters here, do not remove

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof Demande)) {
            return false;
        }
        return id != null && id.equals(((Demande) o).id);
    }

    @Override
    public int hashCode() {
        return 31;
    }

    @Override
    public String toString() {
        return "Demande{" +
            "id=" + getId() +
            ", lastName='" + getLastName() + "'" +
            ", firstName='" + getFirstName() + "'" +
            ", imagePiece='" + getImagePiece() + "'" +
            ", imagePieceContentType='" + getImagePieceContentType() + "'" +
            "}";
    }
}
