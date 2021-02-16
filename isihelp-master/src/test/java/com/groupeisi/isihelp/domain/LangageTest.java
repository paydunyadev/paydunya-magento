package com.groupeisi.isihelp.domain;

import org.junit.jupiter.api.Test;
import static org.assertj.core.api.Assertions.assertThat;
import com.groupeisi.isihelp.web.rest.TestUtil;

public class LangageTest {

    @Test
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Langage.class);
        Langage langage1 = new Langage();
        langage1.setId(1L);
        Langage langage2 = new Langage();
        langage2.setId(langage1.getId());
        assertThat(langage1).isEqualTo(langage2);
        langage2.setId(2L);
        assertThat(langage1).isNotEqualTo(langage2);
        langage1.setId(null);
        assertThat(langage1).isNotEqualTo(langage2);
    }
}
