package com.okta.developer.blog.web.rest;

import com.okta.developer.blog.DemandeApp;
import com.okta.developer.blog.config.TestSecurityConfiguration;
import com.okta.developer.blog.domain.Type;
import com.okta.developer.blog.repository.TypeRepository;
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
 * Integration tests for the {@Link TypeResource} REST controller.
 */
@SpringBootTest(classes = {DemandeApp.class, TestSecurityConfiguration.class})
public class TypeResourceIT {

    private static final String DEFAULT_TITLE = "AAAAAAAAAA";
    private static final String UPDATED_TITLE = "BBBBBBBBBB";

    @Autowired
    private TypeRepository typeRepository;

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

    private MockMvc restTypeMockMvc;

    private Type type;

    @BeforeEach
    public void setup() {
        MockitoAnnotations.initMocks(this);
        final TypeResource typeResource = new TypeResource(typeRepository);
        this.restTypeMockMvc = MockMvcBuilders.standaloneSetup(typeResource)
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
    public static Type createEntity(EntityManager em) {
        Type type = new Type()
            .title(DEFAULT_TITLE);
        return type;
    }
    /**
     * Create an updated entity for this test.
     *
     * This is a static method, as tests for other entities might also need it,
     * if they test an entity which requires the current entity.
     */
    public static Type createUpdatedEntity(EntityManager em) {
        Type type = new Type()
            .title(UPDATED_TITLE);
        return type;
    }

    @BeforeEach
    public void initTest() {
        type = createEntity(em);
    }

    @Test
    @Transactional
    public void createType() throws Exception {
        int databaseSizeBeforeCreate = typeRepository.findAll().size();

        // Create the Type
        restTypeMockMvc.perform(post("/api/types")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(type)))
            .andExpect(status().isCreated());

        // Validate the Type in the database
        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeCreate + 1);
        Type testType = typeList.get(typeList.size() - 1);
        assertThat(testType.getTitle()).isEqualTo(DEFAULT_TITLE);
    }

    @Test
    @Transactional
    public void createTypeWithExistingId() throws Exception {
        int databaseSizeBeforeCreate = typeRepository.findAll().size();

        // Create the Type with an existing ID
        type.setId(1L);

        // An entity with an existing ID cannot be created, so this API call must fail
        restTypeMockMvc.perform(post("/api/types")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(type)))
            .andExpect(status().isBadRequest());

        // Validate the Type in the database
        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeCreate);
    }


    @Test
    @Transactional
    public void checkTitleIsRequired() throws Exception {
        int databaseSizeBeforeTest = typeRepository.findAll().size();
        // set the field null
        type.setTitle(null);

        // Create the Type, which fails.

        restTypeMockMvc.perform(post("/api/types")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(type)))
            .andExpect(status().isBadRequest());

        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeTest);
    }

    @Test
    @Transactional
    public void getAllTypes() throws Exception {
        // Initialize the database
        typeRepository.saveAndFlush(type);

        // Get all the typeList
        restTypeMockMvc.perform(get("/api/types?sort=id,desc"))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_UTF8_VALUE))
            .andExpect(jsonPath("$.[*].id").value(hasItem(type.getId().intValue())))
            .andExpect(jsonPath("$.[*].title").value(hasItem(DEFAULT_TITLE.toString())));
    }
    
    @Test
    @Transactional
    public void getType() throws Exception {
        // Initialize the database
        typeRepository.saveAndFlush(type);

        // Get the type
        restTypeMockMvc.perform(get("/api/types/{id}", type.getId()))
            .andExpect(status().isOk())
            .andExpect(content().contentType(MediaType.APPLICATION_JSON_UTF8_VALUE))
            .andExpect(jsonPath("$.id").value(type.getId().intValue()))
            .andExpect(jsonPath("$.title").value(DEFAULT_TITLE.toString()));
    }

    @Test
    @Transactional
    public void getNonExistingType() throws Exception {
        // Get the type
        restTypeMockMvc.perform(get("/api/types/{id}", Long.MAX_VALUE))
            .andExpect(status().isNotFound());
    }

    @Test
    @Transactional
    public void updateType() throws Exception {
        // Initialize the database
        typeRepository.saveAndFlush(type);

        int databaseSizeBeforeUpdate = typeRepository.findAll().size();

        // Update the type
        Type updatedType = typeRepository.findById(type.getId()).get();
        // Disconnect from session so that the updates on updatedType are not directly saved in db
        em.detach(updatedType);
        updatedType
            .title(UPDATED_TITLE);

        restTypeMockMvc.perform(put("/api/types")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(updatedType)))
            .andExpect(status().isOk());

        // Validate the Type in the database
        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeUpdate);
        Type testType = typeList.get(typeList.size() - 1);
        assertThat(testType.getTitle()).isEqualTo(UPDATED_TITLE);
    }

    @Test
    @Transactional
    public void updateNonExistingType() throws Exception {
        int databaseSizeBeforeUpdate = typeRepository.findAll().size();

        // Create the Type

        // If the entity doesn't have an ID, it will throw BadRequestAlertException
        restTypeMockMvc.perform(put("/api/types")
            .contentType(TestUtil.APPLICATION_JSON_UTF8)
            .content(TestUtil.convertObjectToJsonBytes(type)))
            .andExpect(status().isBadRequest());

        // Validate the Type in the database
        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeUpdate);
    }

    @Test
    @Transactional
    public void deleteType() throws Exception {
        // Initialize the database
        typeRepository.saveAndFlush(type);

        int databaseSizeBeforeDelete = typeRepository.findAll().size();

        // Delete the type
        restTypeMockMvc.perform(delete("/api/types/{id}", type.getId())
            .accept(TestUtil.APPLICATION_JSON_UTF8))
            .andExpect(status().isNoContent());

        // Validate the database is empty
        List<Type> typeList = typeRepository.findAll();
        assertThat(typeList).hasSize(databaseSizeBeforeDelete - 1);
    }

    @Test
    @Transactional
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Type.class);
        Type type1 = new Type();
        type1.setId(1L);
        Type type2 = new Type();
        type2.setId(type1.getId());
        assertThat(type1).isEqualTo(type2);
        type2.setId(2L);
        assertThat(type1).isNotEqualTo(type2);
        type1.setId(null);
        assertThat(type1).isNotEqualTo(type2);
    }
}
