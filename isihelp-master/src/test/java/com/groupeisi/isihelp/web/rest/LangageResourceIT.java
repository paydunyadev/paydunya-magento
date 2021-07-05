package com.groupeisi.isihelp.web.rest;

import com.groupeisi.isihelp.IsiHelpApp;
import com.groupeisi.isihelp.domain.Langage;
import com.groupeisi.isihelp.repository.LangageRepository;

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
 * Integration tests for the {@link LangageResource} REST controller.
 */
@SpringBootTest(classes = IsiHelpApp.class)
@AutoConfigureMockMvc
@WithMockUser
public class LangageResourceIT {

    private static final String DEFAULT_LIBELLE = "AAAAAAAAAA";
    private static final String UPDATED_LIBELLE = "BBBBBBBBBB";

    private static final Boolean DEFAULT_PUBLISH = false;
    private static final Boolean UPDATED_PUBLISH = true;

    @Autowired
    private LangageRepository langageRepository;

    @Autowired
    private EntityManager em;

    @Autowired
    private MockMvc restLangageMockMvc;

    private Langage langage;

    /**
     * Create an entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Langage createEntity(EntityManager em) {
        Langage langage = new Langage()
            .libelle(DEFAULT_LIBELLE)
            .publish(DEFAULT_PUBLISH);
        return langage;
    }
    /**
     * Create an updated entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Langage createUpdatedEntity(EntityManager em) {
        Langage langage = new Langage()
            .libelle(UPDATED_LIBELLE)
            .publish(UPDATED_PUBLISH);
        return langage;
    }

    @BeforeEach
    public void initTest() {
        langage = createEntity(em);
    }

    @Test
    @Transactional
    public void createLangage() throws Exception {
        int databaseSizeBeforeCreate = langageRepository.findAll().size();
        // Create the Langage
        restLangageMockMvc.perform(post("/api/langages")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(langage)))
            .andExpect(status().isCreated());

        // Validate the Langage in the database
        List<Langage> langageList = langageRepository.findAll();
        assertThat(langageList).hasSize(databaseSizeBeforeCreate + 1);
        Langage testLangage = langageList.get(langageList.size() - 1);
        assertThat(testLangage.getLibelle()).isEqualTo(DEFAULT_LIBELLE);
        assertThat(testLangage.isPublish()).isEqualTo(DEFAULT_PUBLISH);
    }

    @Test
    @Transactional
    public void createLangageWithExistingId() throws Exception {
        int databaseSizeBeforeCreate = langageRepository.findAll().size();

        // Create the Langage with an existing ID
        langage.setId(1L);

        // An entity with an existing ID cannot be created, so this API call must fail
        restLangageMockMvc.perform(post("/api/langages")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(langage)))
            .andExpect(status().isBadRequest());

        // Validate the Langage in the database
        List<Langage> langageList = langageRepository.findAll();
        assertThat(langageList).hasSize(databaseSizeBeforeCreate);
    }


    @Test
    @Transactional
    public void getAllLangages() throws Exception {
        // Initialize the database
        langageRepository.saveAndFlush(langage);

        // Get all the langageList
        restLangageMockMvc.perform(get("/api/langages?sort=id,desc"))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.[*].id").value(hasItem(langage.getId().intValue())))
            .andExpect(jsonPath("$.[*].libelle").value(hasItem(DEFAULT_LIBELLE)))
            .andExpect(jsonPath("$.[*].publish").value(hasItem(DEFAULT_PUBLISH.booleanValue())));
    }
    
    @Test
    @Transactional
    public void getLangage() throws Exception {
        // Initialize the database
        langageRepository.saveAndFlush(langage);

        // Get the langage
        restLangageMockMvc.perform(get("/api/langages/{id}", langage.getId()))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.id").value(langage.getId().intValue()))
            .andExpect(jsonPath("$.libelle").value(DEFAULT_LIBELLE))
            .andExpect(jsonPath("$.publish").value(DEFAULT_PUBLISH.booleanValue()));
    }
    @Test
    @Transactional
    public void getNonExistingLangage() throws Exception {
        // Get the langage
        restLangageMockMvc.perform(get("/api/langages/{id}", Long.MAX_VALUE))
            .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    public void updateLangage() throws Exception {
        // Initialize the database
        langageRepository.saveAndFlush(langage);

        int databaseSizeBeforeUpdate = langageRepository.findAll().size();

        // Update the langage
        Langage updatedLangage = langageRepository.findById(langage.getId()).get();
        // Disconnect from session so that the updates on updatedLangage are not directly saved in db
        em.detach(updatedLangage);
        updatedLangage
            .libelle(UPDATED_LIBELLE)
            .publish(UPDATED_PUBLISH);

        restLangageMockMvc.perform(put("/api/langages")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(updatedLangage)))
            .andExpect(status().isOk());

        // Validate the Langage in the database
        List<Langage> langageList = langageRepository.findAll();
        assertThat(langageList).hasSize(databaseSizeBeforeUpdate);
        Langage testLangage = langageList.get(langageList.size() - 1);
        assertThat(testLangage.getLibelle()).isEqualTo(UPDATED_LIBELLE);
        assertThat(testLangage.isPublish()).isEqualTo(UPDATED_PUBLISH);
    }

    @Test
    @Transactional
    public void updateNonExistingLangage() throws Exception {
        int databaseSizeBeforeUpdate = langageRepository.findAll().size();

        // If the entity doesn't have an ID, it will throw BadRequestAlertException
        restLangageMockMvc.perform(put("/api/langages")
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(langage)))
            .andExpect(status().isBadRequest());

        // Validate the Langage in the database
        List<Langage> langageList = langageRepository.findAll();
        assertThat(langageList).hasSize(databaseSizeBeforeUpdate);
    }

    @Test
    @Transactional
    public void deleteLangage() throws Exception {
        // Initialize the database
        langageRepository.saveAndFlush(langage);

        int databaseSizeBeforeDelete = langageRepository.findAll().size();

        // Delete the langage
        restLangageMockMvc.perform(delete("/api/langages/{id}", langage.getId())
            .accept(MediaType.APPLICATION_JSON))
            .andExpect(status().isNoContent());

        // Validate the database contains one less item
        List<Langage> langageList = langageRepository.findAll();
        assertThat(langageList).hasSize(databaseSizeBeforeDelete - 1);
    }
}
