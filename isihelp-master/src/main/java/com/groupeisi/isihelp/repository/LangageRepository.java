package com.groupeisi.isihelp.repository;

import com.groupeisi.isihelp.domain.Langage;

import org.springframework.data.jpa.repository.*;
import org.springframework.stereotype.Repository;

/**
 * Spring Data  repository for the Langage entity.
 */
@SuppressWarnings("unused")
@Repository
public interface LangageRepository extends JpaRepository<Langage, Long> {
}
