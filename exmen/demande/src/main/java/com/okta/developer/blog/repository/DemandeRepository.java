package com.okta.developer.blog.repository;

import com.okta.developer.blog.domain.Demande;
import org.springframework.data.jpa.repository.*;
import org.springframework.stereotype.Repository;

import java.util.List;

/**
 * Spring Data  repository for the Demande entity.
 */
@SuppressWarnings("unused")
@Repository
public interface DemandeRepository extends JpaRepository<Demande, Long> {

    @Query("select demande from Demande demande where demande.user.login = ?#{principal.preferredUsername}")
    List<Demande> findByUserIsCurrentUser();

}
