package com.api.myapp.domain;


import javax.persistence.*;

import java.io.Serializable;
import java.time.LocalDate;

/**
 * A Covid.
 */
@Entity
@Table(name = "covid")
public class Covid implements Serializable {

    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "nbrtest")
    private String nbrtest;

    @Column(name = "positif")
    private String positif;

    @Column(name = "negatif")
    private String negatif;

    @Column(name = "gueris")
    private String gueris;

    @Column(name = "deces")
    private String deces;

    @Column(name = "date")
    private LocalDate date;

    // jhipster-needle-entity-add-field - JHipster will add fields here
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNbrtest() {
        return nbrtest;
    }

    public Covid nbrtest(String nbrtest) {
        this.nbrtest = nbrtest;
        return this;
    }

    public void setNbrtest(String nbrtest) {
        this.nbrtest = nbrtest;
    }

    public String getPositif() {
        return positif;
    }

    public Covid positif(String positif) {
        this.positif = positif;
        return this;
    }

    public void setPositif(String positif) {
        this.positif = positif;
    }

    public String getNegatif() {
        return negatif;
    }

    public Covid negatif(String negatif) {
        this.negatif = negatif;
        return this;
    }

    public void setNegatif(String negatif) {
        this.negatif = negatif;
    }

    public String getGueris() {
        return gueris;
    }

    public Covid gueris(String gueris) {
        this.gueris = gueris;
        return this;
    }

    public void setGueris(String gueris) {
        this.gueris = gueris;
    }

    public String getDeces() {
        return deces;
    }

    public Covid deces(String deces) {
        this.deces = deces;
        return this;
    }

    public void setDeces(String deces) {
        this.deces = deces;
    }

    public LocalDate getDate() {
        return date;
    }

    public Covid date(LocalDate date) {
        this.date = date;
        return this;
    }

    public void setDate(LocalDate date) {
        this.date = date;
    }
    // jhipster-needle-entity-add-getters-setters - JHipster will add getters and setters here

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof Covid)) {
            return false;
        }
        return id != null && id.equals(((Covid) o).id);
    }

    @Override
    public int hashCode() {
        return 31;
    }

    // prettier-ignore
    @Override
    public String toString() {
        return "Covid{" +
            "id=" + getId() +
            ", nbrtest='" + getNbrtest() + "'" +
            ", positif='" + getPositif() + "'" +
            ", negatif='" + getNegatif() + "'" +
            ", gueris='" + getGueris() + "'" +
            ", deces='" + getDeces() + "'" +
            ", date='" + getDate() + "'" +
            "}";
    }
}
