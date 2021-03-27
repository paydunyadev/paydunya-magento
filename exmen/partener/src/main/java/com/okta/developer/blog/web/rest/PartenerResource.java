package com.okta.developer.blog.web.rest;

import com.okta.developer.blog.domain.Partener;
import com.okta.developer.blog.repository.PartenerRepository;
import com.okta.developer.blog.web.rest.errors.BadRequestAlertException;

import io.github.jhipster.web.util.HeaderUtil;
import io.github.jhipster.web.util.ResponseUtil;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.net.URI;
import java.net.URISyntaxException;

import java.util.List;
import java.util.Optional;

/**
 * REST controller for managing {@link com.okta.developer.blog.domain.Partener}.
 */
@RestController
@RequestMapping("/api")
public class PartenerResource {

    private final Logger log = LoggerFactory.getLogger(PartenerResource.class);

    private static final String ENTITY_NAME = "partenerPartener";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final PartenerRepository partenerRepository;

    public PartenerResource(PartenerRepository partenerRepository) {
        this.partenerRepository = partenerRepository;
    }

    /**
     * {@code POST  /parteners} : Create a new partener.
     *
     * @param partener the partener to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new partener, or with status {@code 400 (Bad Request)} if the partener has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/parteners")
    public ResponseEntity<Partener> createPartener(@Valid @RequestBody Partener partener) throws URISyntaxException {
        log.debug("REST request to save Partener : {}", partener);
        if (partener.getId() != null) {
            throw new BadRequestAlertException("A new partener cannot already have an ID", ENTITY_NAME, "idexists");
        }
        Partener result = partenerRepository.save(partener);
        return ResponseEntity.created(new URI("/api/parteners/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, true, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /parteners} : Updates an existing partener.
     *
     * @param partener the partener to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated partener,
     * or with status {@code 400 (Bad Request)} if the partener is not valid,
     * or with status {@code 500 (Internal Server Error)} if the partener couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/parteners")
    public ResponseEntity<Partener> updatePartener(@Valid @RequestBody Partener partener) throws URISyntaxException {
        log.debug("REST request to update Partener : {}", partener);
        if (partener.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }
        Partener result = partenerRepository.save(partener);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, true, ENTITY_NAME, partener.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /parteners} : get all the parteners.
     *
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of parteners in body.
     */
    @GetMapping("/parteners")
    public List<Partener> getAllParteners() {
        log.debug("REST request to get all Parteners");
        return partenerRepository.findAll();
    }

    /**
     * {@code GET  /parteners/:id} : get the "id" partener.
     *
     * @param id the id of the partener to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the partener, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/parteners/{id}")
    public ResponseEntity<Partener> getPartener(@PathVariable Long id) {
        log.debug("REST request to get Partener : {}", id);
        Optional<Partener> partener = partenerRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(partener);
    }

    /**
     * {@code DELETE  /parteners/:id} : delete the "id" partener.
     *
     * @param id the id of the partener to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/parteners/{id}")
    public ResponseEntity<Void> deletePartener(@PathVariable Long id) {
        log.debug("REST request to delete Partener : {}", id);
        partenerRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, true, ENTITY_NAME, id.toString())).build();
    }
}
