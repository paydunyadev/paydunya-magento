package com.okta.developer.blog.web.rest;

import com.okta.developer.blog.PartenerApp;
import com.okta.developer.blog.config.TestSecurityConfiguration;
import com.okta.developer.blog.domain.Partener;
import com.okta.developer.blog.repository.PartenerRepository;
import com.okta.developer.blog.web.rest.errors.ExceptionTranslator;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.MockitoAnnotations;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.data.web.PageableHandlerMethodArgumentResolver;
import org.springframework.http.MediaType;
import org.springframework.http.converter.json.MappingJackson2HttpMessageConverter;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.setup.MockMvcBuilders;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.validation.Validator;

import javax.persistence.EntityManager;
import java.util.List;

import static com.okta.developer.blog.web.rest.TestUtil.createFormattingConversionService;
import static org.assertj.core.api.Assertions.assertThat;
import static org.hamcrest.Matchers.hasItem;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.*;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

/**
 * Integration tests for the {@Link PartenerResource} REST controller.
 */
@SpringBootTest(classes = {PartenerApp.class, TestSecurityConfiguration.class})
public class PartenerResourceIT {

    private static final String DEFAULT_TITLE = "AAAAAAAAAA";
    private static final String UPDATED_TITLE = "BBBBBBBBBB";

    @Autowired
    private PartenerRepository partenerRepository;

    @Autowired
    private MappingJackson2HttpMessageConverter jacksonMessageConverter;

    @Autowired
    private PageableHandlerMethodArgumentResolver pageableArgumentResolver;

    @Autowired
    private ExceptionTranslator exceptionTranslator;

    @Autowired
    private EntityManager em;

    @Autowired
    private Validator validator;

    private MockMvc restPartenerMockMvc;

    private Partener partener;

    @BeforeEach
    public void setup() {
        MockitoAnnotations.initMocks(this);
        final PartenerResource partenerResource = new PartenerResource(partenerRepository);
        this.restPartenerMockMvc = MockMvcBuilders.standaloneSetup(partenerResource)
            .setCustomArgumentResolvers(pageableArgumentResolver)
            .setControllerAdvice(exceptionTranslator)
            .setConversionService(createFormattingConversionService())
            .setMessageConverters(jacksonMessageConverter)
            .setValidator(validator).build();
    }

    /**
     * Create an entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Partener createEntity(EntityManager em) {
        Partener partener = new Partener()
            .title(DEFAULT_TITLE);
        return partener;
    }
    /**
     * Create an updated entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Partener createUpdatedEntity(EntityManager em) {
        Partener partener = new Partener()
            .title(UPDATED_TITLE);
        return partener;
    }

    @BeforeEach
    public void initTest() {
        partener = createEntity(em);
    }

    @Test
    @Transactional
    public void createPartener() throws Exception {
        int databaseSizeBeforeCreate = partenerRepository.findAll().size();

        // Create the Partener
        restPartenerMockMvc.perform(post("/api/parteners")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(partener)))
            .andExpect(status().isCreated());

        // Validate the Partener in the database
        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeCreate + 1);
        Partener testPartener = partenerList.get(partenerList.size() - 1);
        assertThat(testPartener.getTitle()).isEqualTo(DEFAULT_TITLE);
    }

    @Test
    @Transactional
    public void createPartenerWithExistingId() throws Exception {
        int databaseSizeBeforeCreate = partenerRepository.findAll().size();

        // Create the Partener with an existing ID
        partener.setId(1L);

        // An entity with an existing ID cannot be created, so this API call must fail
        restPartenerMockMvc.perform(post("/api/parteners")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(partener)))
            .andExpect(status().isBadRequest());

        // Validate the Partener in the database
        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeCreate);
    }


    @Test
    @Transactional
    public void checkTitleIsRequired() throws Exception {
        int databaseSizeBeforeTest = partenerRepository.findAll().size();
        // set the field null
        partener.setTitle(null);

        // Create the Partener, which fails.

        restPartenerMockMvc.perform(post("/api/parteners")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(partener)))
            .andExpect(status().isBadRequest());

        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeTest);
    }

    @Test
    @Transactional
    public void getAllParteners() throws Exception {
        // Initialize the database
        partenerRepository.saveAndFlush(partener);

        // Get all the partenerList
        restPartenerMockMvc.perform(get("/api/parteners?sort=id,desc"))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_UTF8_VALUE))
            .andExpect(jsonPath("$.[*].id").value(hasItem(partener.getId().intValue())))
            .andExpect(jsonPath("$.[*].title").value(hasItem(DEFAULT_TITLE.toString())));
    }
    
    @Test
    @Transactional
    public void getPartener() throws Exception {
        // Initialize the database
        partenerRepository.saveAndFlush(partener);

        // Get the partener
        restPartenerMockMvc.perform(get("/api/parteners/{id}", partener.getId()))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_UTF8_VALUE))
            .andExpect(jsonPath("$.id").value(partener.getId().intValue()))
            .andExpect(jsonPath("$.title").value(DEFAULT_TITLE.toString()));
    }

    @Test
    @Transactional
    public void getNonExistingPartener() throws Exception {
        // Get the partener
        restPartenerMockMvc.perform(get("/api/parteners/{id}", Long.MAX_VALUE))
            .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    public void updatePartener() throws Exception {
        // Initialize the database
        partenerRepository.saveAndFlush(partener);

        int databaseSizeBeforeUpdate = partenerRepository.findAll().size();

        // Update the partener
        Partener updatedPartener = partenerRepository.findById(partener.getId()).get();
        // Disconnect from session so that the updates on updatedPartener are not directly saved in db
        em.detach(updatedPartener);
        updatedPartener
            .title(UPDATED_TITLE);

        restPartenerMockMvc.perform(put("/api/parteners")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(updatedPartener)))
            .andExpect(status().isOk());

        // Validate the Partener in the database
        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeUpdate);
        Partener testPartener = partenerList.get(partenerList.size() - 1);
        assertThat(testPartener.getTitle()).isEqualTo(UPDATED_TITLE);
    }

    @Test
    @Transactional
    public void updateNonExistingPartener() throws Exception {
        int databaseSizeBeforeUpdate = partenerRepository.findAll().size();

        // Create the Partener

        // If the entity doesn't have an ID, it will throw BadRequestAlertException
        restPartenerMockMvc.perform(put("/api/parteners")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(partener)))
            .andExpect(status().isBadRequest());

        // Validate the Partener in the database
        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeUpdate);
    }

    @Test
    @Transactional
    public void deletePartener() throws Exception {
        // Initialize the database
        partenerRepository.saveAndFlush(partener);

        int databaseSizeBeforeDelete = partenerRepository.findAll().size();

        // Delete the partener
        restPartenerMockMvc.perform(delete("/api/parteners/{id}", partener.getId())
            .accept(TestUtil.APPLICATION_JSON_UTF8))
            .andExpect(status().isNoContent());

        // Validate the database is empty
        List<Partener> partenerList = partenerRepository.findAll();
        assertThat(partenerList).hasSize(databaseSizeBeforeDelete - 1);
    }

    @Test
    @Transactional
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Partener.class);
        Partener partener1 = new Partener();
        partener1.setId(1L);
        Partener partener2 = new Partener();
        partener2.setId(partener1.getId());
        assertThat(partener1).isEqualTo(partener2);
        partener2.setId(2L);
        assertThat(partener1).isNotEqualTo(partener2);
        partener1.setId(null);
        assertThat(partener1).isNotEqualTo(partener2);
    }
}
