package com.groupeisi.isihelp.domain;

import org.junit.jupiter.api.Test;
import static org.assertj.core.api.Assertions.assertThat;
import com.groupeisi.isihelp.web.rest.TestUtil;

public class CommentaireTest {

    @Test
    public void equalsVerifier() throws Exception {
        TestUtil.equalsVerifier(Commentaire.class);
        Commentaire commentaire1 = new Commentaire();
        commentaire1.setId(1L);
        Commentaire commentaire2 = new Commentaire();
        commentaire2.setId(commentaire1.getId());
        assertThat(commentaire1).isEqualTo(commentaire2);
        commentaire2.setId(2L);
        assertThat(commentaire1).isNotEqualTo(commentaire2);
        commentaire1.setId(null);
        assertThat(commentaire1).isNotEqualTo(commentaire2);
    }
}
