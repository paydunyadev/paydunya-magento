package com.api.myapp.config;

import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.boot.web.servlet.ServletRegistrationBean;
import org.springframework.context.ApplicationContext;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.io.ClassPathResource;
import org.springframework.ws.config.annotation.EnableWs;
import org.springframework.ws.config.annotation.WsConfigurerAdapter;
import org.springframework.ws.transport.http.MessageDispatcherServlet;
import org.springframework.ws.wsdl.wsdl11.DefaultWsdl11Definition;
import org.springframework.xml.xsd.SimpleXsdSchema;
import org.springframework.xml.xsd.XsdSchema;

@EnableWs
@Configuration
public class WebServiceConfig extends WsConfigurerAdapter {

    public static final String HTTP_WS_M2GL = "http://ws.groupeisi.com";

    @Bean
    public ServletRegistrationBean messageDispatcherServlet(ApplicationContext applicationContext) {
        MessageDispatcherServlet servlet = new MessageDispatcherServlet();
        servlet.setApplicationContext(applicationContext);
        servlet.setTransformWsdlLocations(true);
        return new ServletRegistrationBean(servlet, "/ws/*");
    }



    @Bean
    @Qualifier("infoSchema")
    public XsdSchema infoSchema() {
        return new SimpleXsdSchema(new ClassPathResource("schema.xsd"));
    }

    @Bean
    @Qualifier("covid19InfoSchema")
    public XsdSchema covid19InfoSchema() {
        return new SimpleXsdSchema(new ClassPathResource("covid19InfoSchema.xsd"));
    }


    @Bean(name = "infos")
    public DefaultWsdl11Definition infosWsdlDefinition(@Qualifier("infoSchema") XsdSchema infoSchema) {
        DefaultWsdl11Definition wsdl11Definition = new DefaultWsdl11Definition();
        wsdl11Definition.setPortTypeName("infoPort");
        wsdl11Definition.setLocationUri("/ws");
        wsdl11Definition.setTargetNamespace(HTTP_WS_M2GL);
        wsdl11Definition.setSchema(infoSchema);
        return wsdl11Definition;
    }

    @Bean(name = "covid19infos")
    public DefaultWsdl11Definition infosCovid19WsdlDefinition(@Qualifier("covid19InfoSchema") XsdSchema covid19InfoSchema) {
        DefaultWsdl11Definition wsdl11Definition = new DefaultWsdl11Definition();
        wsdl11Definition.setPortTypeName("infoPort");
        wsdl11Definition.setLocationUri("/ws");
        wsdl11Definition.setTargetNamespace(HTTP_WS_M2GL);
        wsdl11Definition.setSchema(covid19InfoSchema);
        return wsdl11Definition;
    }
}
