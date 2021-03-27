package com.okta.developer.blog.web.rest;

import com.okta.developer.blog.domain.Demande;
import com.okta.developer.blog.repository.DemandeRepository;
import com.okta.developer.blog.repository.UserRepository;
import com.okta.developer.blog.web.rest.errors.BadRequestAlertException;

import io.github.jhipster.web.util.HeaderUtil;
import io.github.jhipster.web.util.PaginationUtil;
import io.github.jhipster.web.util.ResponseUtil;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.util.MultiValueMap;
import org.springframework.web.util.UriComponentsBuilder;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.net.URI;
import java.net.URISyntaxException;

import java.util.List;
import java.util.Optional;

/**
 * REST controller for managing {@link com.okta.developer.blog.domain.Demande}.
 */
@RestController
@RequestMapping("/api")
public class DemandeResource {

    private final Logger log = LoggerFactory.getLogger(DemandeResource.class);

    private static final String ENTITY_NAME = "demandeDemande";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final DemandeRepository demandeRepository;

    private final UserRepository userRepository;

    public DemandeResource(DemandeRepository demandeRepository, UserRepository userRepository) {
        this.demandeRepository = demandeRepository;
        this.userRepository = userRepository;
    }

    /**
     * {@code POST  /demandes} : Create a new demande.
     *
     * @param demande the demande to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new demande, or with status {@code 400 (Bad Request)} if the demande has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/demandes")
    public ResponseEntity<Demande> createDemande(@Valid @RequestBody Demande demande) throws URISyntaxException {
        log.debug("REST request to save Demande : {}", demande);
        if (demande.getId() != null) {
            throw new BadRequestAlertException("A new demande cannot already have an ID", ENTITY_NAME, "idexists");
        }

        if (demande.getUser() != null) {
            // Save user in case it's new and only exists in gateway
            userRepository.save(demande.getUser());
        }
        Demande result = demandeRepository.save(demande);
        return ResponseEntity.created(new URI("/api/demandes/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, true, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /demandes} : Updates an existing demande.
     *
     * @param demande the demande to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated demande,
     * or with status {@code 400 (Bad Request)} if the demande is not valid,
     * or with status {@code 500 (Internal Server Error)} if the demande couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/demandes")
    public ResponseEntity<Demande> updateDemande(@Valid @RequestBody Demande demande) throws URISyntaxException {
        log.debug("REST request to update Demande : {}", demande);
        if (demande.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }

        if (demande.getUser() != null) {
            // Save user in case it's new and only exists in gateway
            userRepository.save(demande.getUser());
        }
        Demande result = demandeRepository.save(demande);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, true, ENTITY_NAME, demande.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /demandes} : get all the demandes.
     *
     * @param pageable the pagination information.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of demandes in body.
     */
    @GetMapping("/demandes")
    public ResponseEntity<List<Demande>> getAllDemandes(Pageable pageable, @RequestParam MultiValueMap<String, String> queryParams, UriComponentsBuilder uriBuilder) {
        log.debug("REST request to get a page of Demandes");
        Page<Demande> page = demandeRepository.findAll(pageable);
        HttpHeaders headers = PaginationUtil.generatePaginationHttpHeaders(uriBuilder.queryParams(queryParams), page);
        return ResponseEntity.ok().headers(headers).body(page.getContent());
    }

    /**
     * {@code GET  /demandes/:id} : get the "id" demande.
     *
     * @param id the id of the demande to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the demande, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/demandes/{id}")
    public ResponseEntity<Demande> getDemande(@PathVariable Long id) {
        log.debug("REST request to get Demande : {}", id);
        Optional<Demande> demande = demandeRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(demande);
    }

    /**
     * {@code DELETE  /demandes/:id} : delete the "id" demande.
     *
     * @param id the id of the demande to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/demandes/{id}")
    public ResponseEntity<Void> deleteDemande(@PathVariable Long id) {
        log.debug("REST request to delete Demande : {}", id);
        demandeRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, true, ENTITY_NAME, id.toString())).build();
    }
}
