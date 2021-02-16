package com.groupeisi.isihelp.web.rest;

import com.groupeisi.isihelp.domain.Commentaire;
import com.groupeisi.isihelp.repository.CommentaireRepository;
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
 * REST controller for managing {@link com.groupeisi.isihelp.domain.Commentaire}.
 */
@RestController
@RequestMapping("/api")
@Transactional
public class CommentaireResource {

    private final Logger log = LoggerFactory.getLogger(CommentaireResource.class);

    private static final String ENTITY_NAME = "commentaire";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final CommentaireRepository commentaireRepository;

    public CommentaireResource(CommentaireRepository commentaireRepository) {
        this.commentaireRepository = commentaireRepository;
    }

    /**
     * {@code POST  /commentaires} : Create a new commentaire.
     *
     * @param commentaire the commentaire to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new commentaire, or with status {@code 400 (Bad Request)} if the commentaire has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/commentaires")
    public ResponseEntity<Commentaire> createCommentaire(@RequestBody Commentaire commentaire) throws URISyntaxException {
        log.debug("REST request to save Commentaire : {}", commentaire);
        if (commentaire.getId() != null) {
            throw new BadRequestAlertException("A new commentaire cannot already have an ID", ENTITY_NAME, "idexists");
        }
        Commentaire result = commentaireRepository.save(commentaire);
        return ResponseEntity.created(new URI("/api/commentaires/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, false, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /commentaires} : Updates an existing commentaire.
     *
     * @param commentaire the commentaire to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated commentaire,
     * or with status {@code 400 (Bad Request)} if the commentaire is not valid,
     * or with status {@code 500 (Internal Server Error)} if the commentaire couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/commentaires")
    public ResponseEntity<Commentaire> updateCommentaire(@RequestBody Commentaire commentaire) throws URISyntaxException {
        log.debug("REST request to update Commentaire : {}", commentaire);
        if (commentaire.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }
        Commentaire result = commentaireRepository.save(commentaire);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, false, ENTITY_NAME, commentaire.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /commentaires} : get all the commentaires.
     *
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of commentaires in body.
     */
    @GetMapping("/commentaires")
    public List<Commentaire> getAllCommentaires() {
        log.debug("REST request to get all Commentaires");
        return commentaireRepository.findAll();
    }

    /**
     * {@code GET  /commentaires/:id} : get the "id" commentaire.
     *
     * @param id the id of the commentaire to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the commentaire, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/commentaires/{id}")
    public ResponseEntity<Commentaire> getCommentaire(@PathVariable Long id) {
        log.debug("REST request to get Commentaire : {}", id);
        Optional<Commentaire> commentaire = commentaireRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(commentaire);
    }

    /**
     * {@code DELETE  /commentaires/:id} : delete the "id" commentaire.
     *
     * @param id the id of the commentaire to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/commentaires/{id}")
    public ResponseEntity<Void> deleteCommentaire(@PathVariable Long id) {
        log.debug("REST request to delete Commentaire : {}", id);
        commentaireRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, false, ENTITY_NAME, id.toString())).build();
    }
}
