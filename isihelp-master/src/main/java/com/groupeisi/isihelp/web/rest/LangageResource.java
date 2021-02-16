package com.groupeisi.isihelp.web.rest;

import com.groupeisi.isihelp.domain.Langage;
import com.groupeisi.isihelp.repository.LangageRepository;
import com.groupeisi.isihelp.web.rest.errors.BadRequestAlertException;

import io.github.jhipster.web.util.HeaderUtil;
import io.github.jhipster.web.util.ResponseUtil;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.http.ResponseEntity;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.bind.annotation.*;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;
import java.util.Optional;

/**
 * REST controller for managing {@link com.groupeisi.isihelp.domain.Langage}.
 */
@RestController
@RequestMapping("/api")
@Transactional
public class LangageResource {

    private final Logger log = LoggerFactory.getLogger(LangageResource.class);

    private static final String ENTITY_NAME = "langage";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final LangageRepository langageRepository;

    public LangageResource(LangageRepository langageRepository) {
        this.langageRepository = langageRepository;
    }

    /**
     * {@code POST  /langages} : Create a new langage.
     *
     * @param langage the langage to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new langage, or with status {@code 400 (Bad Request)} if the langage has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/langages")
    public ResponseEntity<Langage> createLangage(@RequestBody Langage langage) throws URISyntaxException {
        log.debug("REST request to save Langage : {}", langage);
        if (langage.getId() != null) {
            throw new BadRequestAlertException("A new langage cannot already have an ID", ENTITY_NAME, "idexists");
        }
        Langage result = langageRepository.save(langage);
        return ResponseEntity.created(new URI("/api/langages/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, false, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /langages} : Updates an existing langage.
     *
     * @param langage the langage to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated langage,
     * or with status {@code 400 (Bad Request)} if the langage is not valid,
     * or with status {@code 500 (Internal Server Error)} if the langage couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/langages")
    public ResponseEntity<Langage> updateLangage(@RequestBody Langage langage) throws URISyntaxException {
        log.debug("REST request to update Langage : {}", langage);
        if (langage.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }
        Langage result = langageRepository.save(langage);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, false, ENTITY_NAME, langage.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /langages} : get all the langages.
     *
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of langages in body.
     */
    @GetMapping("/langages")
    public List<Langage> getAllLangages() {
        log.debug("REST request to get all Langages");
        return langageRepository.findAll();
    }

    /**
     * {@code GET  /langages/:id} : get the "id" langage.
     *
     * @param id the id of the langage to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the langage, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/langages/{id}")
    public ResponseEntity<Langage> getLangage(@PathVariable Long id) {
        log.debug("REST request to get Langage : {}", id);
        Optional<Langage> langage = langageRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(langage);
    }

    /**
     * {@code DELETE  /langages/:id} : delete the "id" langage.
     *
     * @param id the id of the langage to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/langages/{id}")
    public ResponseEntity<Void> deleteLangage(@PathVariable Long id) {
        log.debug("REST request to delete Langage : {}", id);
        langageRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, false, ENTITY_NAME, id.toString())).build();
    }
}
