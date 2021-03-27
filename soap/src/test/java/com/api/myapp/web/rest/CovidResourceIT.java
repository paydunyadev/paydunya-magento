package com.api.myapp.web.rest;

import com.api.myapp.SoapApp;
import com.api.myapp.config.TestSecurityConfiguration;
import com.api.myapp.domain.Covid;
import com.api.myapp.repository.CovidRepository;

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
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.List;

import static org.assertj.core.api.Assertions.assertThat;
import static org.hamcrest.Matchers.hasItem;
import static org.springframework.security.test.web.servlet.request.SecurityMockMvcRequestPostProcessors.csrf;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.*;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

/**
 * Integration tests for the {@link CovidResource} REST controller.
 */
@SpringBootTest(classes = { SoapApp.class, TestSecurityConfiguration.class })
@AutoConfigureMockMvc
@WithMockUser
public class CovidResourceIT {

    private static final String DEFAULT_NBRTEST = "AAAAAAAAAA";
    private static final String UPDATED_NBRTEST = "BBBBBBBBBB";

    private static final String DEFAULT_POSITIF = "AAAAAAAAAA";
    private static final String UPDATED_POSITIF = "BBBBBBBBBB";

    private static final String DEFAULT_NEGATIF = "AAAAAAAAAA";
    private static final String UPDATED_NEGATIF = "BBBBBBBBBB";

    private static final String DEFAULT_GUERIS = "AAAAAAAAAA";
    private static final String UPDATED_GUERIS = "BBBBBBBBBB";

    private static final String DEFAULT_DECES = "AAAAAAAAAA";
    private static final String UPDATED_DECES = "BBBBBBBBBB";

    private static final LocalDate DEFAULT_DATE = LocalDate.ofEpochDay(0L);
    private static final LocalDate UPDATED_DATE = LocalDate.now(ZoneId.systemDefault());

    @Autowired
    private CovidRepository covidRepository;

    @Autowired
    private EntityManager em;

    @Autowired
    private MockMvc restCovidMockMvc;

    private Covid covid;

    /**
     * Create an entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Covid createEntity(EntityManager em) {
        Covid covid = new Covid()
            .nbrtest(DEFAULT_NBRTEST)
            .positif(DEFAULT_POSITIF)
            .negatif(DEFAULT_NEGATIF)
            .gueris(DEFAULT_GUERIS)
            .deces(DEFAULT_DECES)
            .date(DEFAULT_DATE);
        return covid;
    }
    /**
     * Create an updated entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Covid createUpdatedEntity(EntityManager em) {
        Covid covid = new Covid()
            .nbrtest(UPDATED_NBRTEST)
            .positif(UPDATED_POSITIF)
            .negatif(UPDATED_NEGATIF)
            .gueris(UPDATED_GUERIS)
            .deces(UPDATED_DECES)
            .date(UPDATED_DATE);
        return covid;
    }

    @BeforeEach
    public void initTest() {
        covid = createEntity(em);
    }

    @Test
    @Transactional
    public void createCovid() throws Exception {
        int databaseSizeBeforeCreate = covidRepository.findAll().size();
        // Create the Covid
        restCovidMockMvc.perform(post("/api/covids").with(csrf())
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(covid)))
            .andExpect(status().isCreated());

        // Validate the Covid in the database
        List<Covid> covidList = covidRepository.findAll();
        assertThat(covidList).hasSize(databaseSizeBeforeCreate + 1);
        Covid testCovid = covidList.get(covidList.size() - 1);
        assertThat(testCovid.getNbrtest()).isEqualTo(DEFAULT_NBRTEST);
        assertThat(testCovid.getPositif()).isEqualTo(DEFAULT_POSITIF);
        assertThat(testCovid.getNegatif()).isEqualTo(DEFAULT_NEGATIF);
        assertThat(testCovid.getGueris()).isEqualTo(DEFAULT_GUERIS);
        assertThat(testCovid.getDeces()).isEqualTo(DEFAULT_DECES);
        assertThat(testCovid.getDate()).isEqualTo(DEFAULT_DATE);
    }

    @Test
    @Transactional
    public void createCovidWithExistingId() throws Exception {
        int databaseSizeBeforeCreate = covidRepository.findAll().size();

        // Create the Covid with an existing ID
        covid.setId(1L);

        // An entity with an existing ID cannot be created, so this API call must fail
        restCovidMockMvc.perform(post("/api/covids").with(csrf())
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(covid)))
            .andExpect(status().isBadRequest());

        // Validate the Covid in the database
        List<Covid> covidList = covidRepository.findAll();
        assertThat(covidList).hasSize(databaseSizeBeforeCreate);
    }


    @Test
    @Transactional
    public void getAllCovids() throws Exception {
        // Initialize the database
        covidRepository.saveAndFlush(covid);

        // Get all the covidList
        restCovidMockMvc.perform(get("/api/covids?sort=id,desc"))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.[*].id").value(hasItem(covid.getId().intValue())))
            .andExpect(jsonPath("$.[*].nbrtest").value(hasItem(DEFAULT_NBRTEST)))
            .andExpect(jsonPath("$.[*].positif").value(hasItem(DEFAULT_POSITIF)))
            .andExpect(jsonPath("$.[*].negatif").value(hasItem(DEFAULT_NEGATIF)))
            .andExpect(jsonPath("$.[*].gueris").value(hasItem(DEFAULT_GUERIS)))
            .andExpect(jsonPath("$.[*].deces").value(hasItem(DEFAULT_DECES)))
            .andExpect(jsonPath("$.[*].date").value(hasItem(DEFAULT_DATE.toString())));
    }
    
    @Test
    @Transactional
    public void getCovid() throws Exception {
        // Initialize the database
        covidRepository.saveAndFlush(covid);

        // Get the covid
        restCovidMockMvc.perform(get("/api/covids/{id}", covid.getId()))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_VALUE))
            .andExpect(jsonPath("$.id").value(covid.getId().intValue()))
            .andExpect(jsonPath("$.nbrtest").value(DEFAULT_NBRTEST))
            .andExpect(jsonPath("$.positif").value(DEFAULT_POSITIF))
            .andExpect(jsonPath("$.negatif").value(DEFAULT_NEGATIF))
            .andExpect(jsonPath("$.gueris").value(DEFAULT_GUERIS))
            .andExpect(jsonPath("$.deces").value(DEFAULT_DECES))
            .andExpect(jsonPath("$.date").value(DEFAULT_DATE.toString()));
    }
    @Test
    @Transactional
    public void getNonExistingCovid() throws Exception {
        // Get the covid
        restCovidMockMvc.perform(get("/api/covids/{id}", Long.MAX_VALUE))
            .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    public void updateCovid() throws Exception {
        // Initialize the database
        covidRepository.saveAndFlush(covid);

        int databaseSizeBeforeUpdate = covidRepository.findAll().size();

        // Update the covid
        Covid updatedCovid = covidRepository.findById(covid.getId()).get();
        // Disconnect from session so that the updates on updatedCovid are not directly saved in db
        em.detach(updatedCovid);
        updatedCovid
            .nbrtest(UPDATED_NBRTEST)
            .positif(UPDATED_POSITIF)
            .negatif(UPDATED_NEGATIF)
            .gueris(UPDATED_GUERIS)
            .deces(UPDATED_DECES)
            .date(UPDATED_DATE);

        restCovidMockMvc.perform(put("/api/covids").with(csrf())
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(updatedCovid)))
            .andExpect(status().isOk());

        // Validate the Covid in the database
        List<Covid> covidList = covidRepository.findAll();
        assertThat(covidList).hasSize(databaseSizeBeforeUpdate);
        Covid testCovid = covidList.get(covidList.size() - 1);
        assertThat(testCovid.getNbrtest()).isEqualTo(UPDATED_NBRTEST);
        assertThat(testCovid.getPositif()).isEqualTo(UPDATED_POSITIF);
        assertThat(testCovid.getNegatif()).isEqualTo(UPDATED_NEGATIF);
        assertThat(testCovid.getGueris()).isEqualTo(UPDATED_GUERIS);
        assertThat(testCovid.getDeces()).isEqualTo(UPDATED_DECES);
        assertThat(testCovid.getDate()).isEqualTo(UPDATED_DATE);
    }

    @Test
    @Transactional
    public void updateNonExistingCovid() throws Exception {
        int databaseSizeBeforeUpdate = covidRepository.findAll().size();

        // If the entity doesn't have an ID, it will throw BadRequestAlertException
        restCovidMockMvc.perform(put("/api/covids").with(csrf())
            .contentType(MediaType.APPLICATION_JSON)
            .content(TestUtil.convertObjectToJsonBytes(covid)))
            .andExpect(status().isBadRequest());

        // Validate the Covid in the database
        List<Covid> covidList = covidRepository.findAll();
        assertThat(covidList).hasSize(databaseSizeBeforeUpdate);
    }

    @Test
    @Transactional
    public void deleteCovid() throws Exception {
        // Initialize the database
        covidRepository.saveAndFlush(covid);

        int databaseSizeBeforeDelete = covidRepository.findAll().size();

        // Delete the covid
        restCovidMockMvc.perform(delete("/api/covids/{id}", covid.getId()).with(csrf())
            .accept(MediaType.APPLICATION_JSON))
            .andExpect(status().isNoContent());

        // Validate the database contains one less item
        List<Covid> covidList = covidRepository.findAll();
        assertThat(covidList).hasSize(databaseSizeBeforeDelete - 1);
    }
}
