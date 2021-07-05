package com.groupeisi.isihelp.domain;

import org.junit.jupiter.api.Test;
import static org.assertj.core.api.Assertions.assertThat;
import com.groupeisi.isihelp.web.rest.TestUtil;

public class TechnoTest {

    @Test
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Techno.class);
        Techno techno1 = new Techno();
        techno1.setId(1L);
        Techno techno2 = new Techno();
        techno2.setId(techno1.getId());
        assertThat(techno1).isEqualTo(techno2);
        techno2.setId(2L);
        assertThat(techno1).isNotEqualTo(techno2);
        techno1.setId(null);
        assertThat(techno1).isNotEqualTo(techno2);
    }
}
