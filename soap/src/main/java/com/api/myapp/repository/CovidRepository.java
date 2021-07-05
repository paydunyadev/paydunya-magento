package com.api.myapp.repository;

import com.api.myapp.domain.Covid;

import org.springframework.data.jpa.repository.*;
import org.springframework.stereotype.Repository;

/**
 * Spring Data  repository for the Covid entity.
 */
@SuppressWarnings("unused")
@Repository
public interface CovidRepository extends JpaRepository<Covid, Long> {
}
