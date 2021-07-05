package com.api.myapp.domain;

import org.junit.jupiter.api.Test;
import static org.assertj.core.api.Assertions.assertThat;
import com.api.myapp.web.rest.TestUtil;

public class CovidTest {

    @Test
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Covid.class);
        Covid covid1 = new Covid();
        covid1.setId(1L);
        Covid covid2 = new Covid();
        covid2.setId(covid1.getId());
        assertThat(covid1).isEqualTo(covid2);
        covid2.setId(2L);
        assertThat(covid1).isNotEqualTo(covid2);
        covid1.setId(null);
        assertThat(covid1).isNotEqualTo(covid2);
    }
}
