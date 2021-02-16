package com.groupeisi.isihelp.web.rest;

import com.groupeisi.isihelp.domain.Techno;
import com.groupeisi.isihelp.repository.TechnoRepository;
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
 * REST controller for managing {@link com.groupeisi.isihelp.domain.Techno}.
 */
@RestController
@RequestMapping("/api")
@Transactional
public class TechnoResource {

    private final Logger log = LoggerFactory.getLogger(TechnoResource.class);

    private static final String ENTITY_NAME = "techno";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final TechnoRepository technoRepository;

    public TechnoResource(TechnoRepository technoRepository) {
        this.technoRepository = technoRepository;
    }

    /**
     * {@code POST  /technos} : Create a new techno.
     *
     * @param techno the techno to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new techno, or with status {@code 400 (Bad Request)} if the techno has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/technos")
    public ResponseEntity<Techno> createTechno(@RequestBody Techno techno) throws URISyntaxException {
        log.debug("REST request to save Techno : {}", techno);
        if (techno.getId() != null) {
            throw new BadRequestAlertException("A new techno cannot already have an ID", ENTITY_NAME, "idexists");
        }
        Techno result = technoRepository.save(techno);
        return ResponseEntity.created(new URI("/api/technos/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, false, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /technos} : Updates an existing techno.
     *
     * @param techno the techno to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated techno,
     * or with status {@code 400 (Bad Request)} if the techno is not valid,
     * or with status {@code 500 (Internal Server Error)} if the techno couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/technos")
    public ResponseEntity<Techno> updateTechno(@RequestBody Techno techno) throws URISyntaxException {
        log.debug("REST request to update Techno : {}", techno);
        if (techno.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }
        Techno result = technoRepository.save(techno);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, false, ENTITY_NAME, techno.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /technos} : get all the technos.
     *
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of technos in body.
     */
    @GetMapping("/technos")
    public List<Techno> getAllTechnos() {
        log.debug("REST request to get all Technos");
        return technoRepository.findAll();
    }

    /**
     * {@code GET  /technos/:id} : get the "id" techno.
     *
     * @param id the id of the techno to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the techno, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/technos/{id}")
    public ResponseEntity<Techno> getTechno(@PathVariable Long id) {
        log.debug("REST request to get Techno : {}", id);
        Optional<Techno> techno = technoRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(techno);
    }

    /**
     * {@code DELETE  /technos/:id} : delete the "id" techno.
     *
     * @param id the id of the techno to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/technos/{id}")
    public ResponseEntity<Void> deleteTechno(@PathVariable Long id) {
        log.debug("REST request to delete Techno : {}", id);
        technoRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, false, ENTITY_NAME, id.toString())).build();
    }
}
