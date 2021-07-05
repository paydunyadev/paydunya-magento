package com.okta.developer.blog.repository;

import com.okta.developer.blog.domain.Partener;
import org.springframework.data.jpa.repository.*;
import org.springframework.stereotype.Repository;


/**
 * Spring Data  repository for the Partener entity.
 */
@SuppressWarnings("unused")
@Repository
public interface PartenerRepository extends JpaRepository<Partener, Long> {

}
