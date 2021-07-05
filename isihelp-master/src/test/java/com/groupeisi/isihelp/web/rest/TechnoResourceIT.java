package com.groupeisi.isihelp.web.rest;

import com.groupeisi.isihelp.IsiHelpApp;
import com.groupeisi.isihelp.domain.Techno;
import com.groupeisi.isihelp.repository.TechnoRepository;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.http.MediaType;
import org.springframework.security.test.context.support.WithMockUser;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.transaction.annotation.Transactional;
import javax.persistence.EntityManager;
import java.util.List;

import static org.assertj.core.api.Assertions.assertThat;
import static org.hamcrest.Matchers.hasItem;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.*;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

/**
 * Integration tests for the {@link TechnoResource} REST controller.
 */
@SpringBootTest(classes = IsiHelpApp.class)
@AutoConfigureMockMvc
@WithMockUser
public class TechnoResourceIT {

    private static final String DEFAULT_LIBELLE = "AAAAAAAAAA";
    private static final String UPDATED_LIBELLE = "BBBBBBBBBB";

    private static final Boolean DEFAULT_PUBLISH = false;
    private static final Boolean UPDATED_PUBLISH = true;

    @Autowired
    private TechnoRepository technoRepository;

    @Autowired
    private EntityManager em;

    @Autowired
    private MockMvc restTechnoMockMvc;

    private Techno techno;

    /**
     * Create an entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Techno createEntity(EntityManager em) {
        Techno techno = new Techno()
            .libelle(DEFAULT_LIBELLE)
            .publish(DEFAULT_PUBLISH);
        return techno;
    }
    /**
     * Create an updated entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Techno createUpdatedEntity(EntityManager em) {
        Techno techno = new Techno()
            .libelle(UPDATED_LIBELLE)
            .publish(UPDATED_PUBLISH);
        return techno;
    }

    @BeforeEach
    public void initTest() {
        techno = createEntity(em);
    }

    @Test
    @Transactional
    public void createTechno() throws Exception {
        int databaseSizeBeforeCreate = technoRepository.findAll().size();
        // Create the Techno
        restTechnoMockMvc.perform(post("/api/technos")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(techno)))
            .andExpect(status().isCreated());

        // Validate the Techno in the database
        List<Techno> technoList = technoRepository.findAll();
        assertThat(technoList).hasSize(databaseSizeBeforeCreate + 1);
        Techno testTechno = technoList.get(technoList.size() - 1);
        assertThat(testTechno.getLibelle()).isEqualTo(DEFAULT_LIBELLE);
        assertThat(testTechno.isPublish()).isEqualTo(DEFAULT_PUBLISH);
    }

    @Test
    @Transactional
    public void createTechnoWithExistingId() throws Exception {
        int databaseSizeBeforeCreate = technoRepository.findAll().size();

        // Create the Techno with an existing ID
        techno.setId(1L);

        // An entity with an existing ID cannot be created, so this API call must fail
        restTechnoMockMvc.perform(post("/api/technos")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(techno)))
            .andExpect(status().isBadRequest());

        // Validate the Techno in the database
        List<Techno> technoList = technoRepository.findAll();
        assertThat(technoList).hasSize(databaseSizeBeforeCreate);
    }


    @Test
    @Transactional
    public void getAllTechnos() throws Exception {
        // Initialize the database
        technoRepository.saveAndFlush(techno);

        // Get all the technoList
        restTechnoMockMvc.perform(get("/api/technos?sort=id,desc"))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.[*].id").value(hasItem(techno.getId().intValue())))
            .andExpect(jsonPath("$.[*].libelle").value(hasItem(DEFAULT_LIBELLE)))
            .andExpect(jsonPath("$.[*].publish").value(hasItem(DEFAULT_PUBLISH.booleanValue())));
    }
    
    @Test
    @Transactional
    public void getTechno() throws Exception {
        // Initialize the database
        technoRepository.saveAndFlush(techno);

        // Get the techno
        restTechnoMockMvc.perform(get("/api/technos/{id}", techno.getId()))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.id").value(techno.getId().intValue()))
            .andExpect(jsonPath("$.libelle").value(DEFAULT_LIBELLE))
            .andExpect(jsonPath("$.publish").value(DEFAULT_PUBLISH.booleanValue()));
    }
    @Test
    @Transactional
    public void getNonExistingTechno() throws Exception {
        // Get the techno
        restTechnoMockMvc.perform(get("/api/technos/{id}", Long.MAX_VALUE))
            .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    public void updateTechno() throws Exception {
        // Initialize the database
        technoRepository.saveAndFlush(techno);

        int databaseSizeBeforeUpdate = technoRepository.findAll().size();

        // Update the techno
        Techno updatedTechno = technoRepository.findById(techno.getId()).get();
        // Disconnect from session so that the updates on updatedTechno are not directly saved in db
        em.detach(updatedTechno);
        updatedTechno
            .libelle(UPDATED_LIBELLE)
            .publish(UPDATED_PUBLISH);

        restTechnoMockMvc.perform(put("/api/technos")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(updatedTechno)))
            .andExpect(status().isOk());

        // Validate the Techno in the database
        List<Techno> technoList = technoRepository.findAll();
        assertThat(technoList).hasSize(databaseSizeBeforeUpdate);
        Techno testTechno = technoList.get(technoList.size() - 1);
        assertThat(testTechno.getLibelle()).isEqualTo(UPDATED_LIBELLE);
        assertThat(testTechno.isPublish()).isEqualTo(UPDATED_PUBLISH);
    }

    @Test
    @Transactional
    public void updateNonExistingTechno() throws Exception {
        int databaseSizeBeforeUpdate = technoRepository.findAll().size();

        // If the entity doesn't have an ID, it will throw BadRequestAlertException
        restTechnoMockMvc.perform(put("/api/technos")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(techno)))
            .andExpect(status().isBadRequest());

        // Validate the Techno in the database
        List<Techno> technoList = technoRepository.findAll();
        assertThat(technoList).hasSize(databaseSizeBeforeUpdate);
    }

    @Test
    @Transactional
    public void deleteTechno() throws Exception {
        // Initialize the database
        technoRepository.saveAndFlush(techno);

        int databaseSizeBeforeDelete = technoRepository.findAll().size();

        // Delete the techno
        restTechnoMockMvc.perform(delete("/api/technos/{id}", techno.getId())
            .accept(MediaType.APPLICATION_JSON))
            .andExpect(status().isNoContent());

        // Validate the database contains one less item
        List<Techno> technoList = technoRepository.findAll();
        assertThat(technoList).hasSize(databaseSizeBeforeDelete - 1);
    }
}
