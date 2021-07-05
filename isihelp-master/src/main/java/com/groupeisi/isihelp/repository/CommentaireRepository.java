package com.groupeisi.isihelp.repository;

import com.groupeisi.isihelp.domain.Commentaire;

import org.springframework.data.jpa.repository.*;
import org.springframework.stereotype.Repository;

/**
 * Spring Data  repository for the Commentaire entity.
 */
@SuppressWarnings("unused")
@Repository
public interface CommentaireRepository extends JpaRepository<Commentaire, Long> {
}
