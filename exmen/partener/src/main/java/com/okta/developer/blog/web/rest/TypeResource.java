package com.okta.developer.blog.web.rest;

import com.okta.developer.blog.domain.Type;
import com.okta.developer.blog.repository.TypeRepository;
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
 * REST controller for managing {@link com.okta.developer.blog.domain.Type}.
 */
@RestController
@RequestMapping("/api")
public class TypeResource {

    private final Logger log = LoggerFactory.getLogger(TypeResource.class);

    private static final String ENTITY_NAME = "partenerType";

    @Value("${jhipster.clientApp.name}")
    private String applicationName;

    private final TypeRepository typeRepository;

    public TypeResource(TypeRepository typeRepository) {
        this.typeRepository = typeRepository;
    }

    /**
     * {@code POST  /types} : Create a new type.
     *
     * @param type the type to create.
     * @return the {@link ResponseEntity} with status {@code 201 (Created)} and with body the new type, or with status {@code 400 (Bad Request)} if the type has already an ID.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PostMapping("/types")
    public ResponseEntity<Type> createType(@Valid @RequestBody Type type) throws URISyntaxException {
        log.debug("REST request to save Type : {}", type);
        if (type.getId() != null) {
            throw new BadRequestAlertException("A new type cannot already have an ID", ENTITY_NAME, "idexists");
        }
        Type result = typeRepository.save(type);
        return ResponseEntity.created(new URI("/api/types/" + result.getId()))
            .headers(HeaderUtil.createEntityCreationAlert(applicationName, true, ENTITY_NAME, result.getId().toString()))
            .body(result);
    }

    /**
     * {@code PUT  /types} : Updates an existing type.
     *
     * @param type the type to update.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the updated type,
     * or with status {@code 400 (Bad Request)} if the type is not valid,
     * or with status {@code 500 (Internal Server Error)} if the type couldn't be updated.
     * @throws URISyntaxException if the Location URI syntax is incorrect.
     */
    @PutMapping("/types")
    public ResponseEntity<Type> updateType(@Valid @RequestBody Type type) throws URISyntaxException {
        log.debug("REST request to update Type : {}", type);
        if (type.getId() == null) {
            throw new BadRequestAlertException("Invalid id", ENTITY_NAME, "idnull");
        }
        Type result = typeRepository.save(type);
        return ResponseEntity.ok()
            .headers(HeaderUtil.createEntityUpdateAlert(applicationName, true, ENTITY_NAME, type.getId().toString()))
            .body(result);
    }

    /**
     * {@code GET  /types} : get all the types.
     *
     * @param pageable the pagination information.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and the list of types in body.
     */
    @GetMapping("/types")
    public ResponseEntity<List<Type>> getAllTypes(Pageable pageable, @RequestParam MultiValueMap<String, String> queryParams, UriComponentsBuilder uriBuilder) {
        log.debug("REST request to get a page of Types");
        Page<Type> page = typeRepository.findAll(pageable);
        HttpHeaders headers = PaginationUtil.generatePaginationHttpHeaders(uriBuilder.queryParams(queryParams), page);
        return ResponseEntity.ok().headers(headers).body(page.getContent());
    }

    /**
     * {@code GET  /types/:id} : get the "id" type.
     *
     * @param id the id of the type to retrieve.
     * @return the {@link ResponseEntity} with status {@code 200 (OK)} and with body the type, or with status {@code 404 (Not Found)}.
     */
    @GetMapping("/types/{id}")
    public ResponseEntity<Type> getType(@PathVariable Long id) {
        log.debug("REST request to get Type : {}", id);
        Optional<Type> type = typeRepository.findById(id);
        return ResponseUtil.wrapOrNotFound(type);
    }

    /**
     * {@code DELETE  /types/:id} : delete the "id" type.
     *
     * @param id the id of the type to delete.
     * @return the {@link ResponseEntity} with status {@code 204 (NO_CONTENT)}.
     */
    @DeleteMapping("/types/{id}")
    public ResponseEntity<Void> deleteType(@PathVariable Long id) {
        log.debug("REST request to delete Type : {}", id);
        typeRepository.deleteById(id);
        return ResponseEntity.noContent().headers(HeaderUtil.createEntityDeletionAlert(applicationName, true, ENTITY_NAME, id.toString())).build();
    }
}
