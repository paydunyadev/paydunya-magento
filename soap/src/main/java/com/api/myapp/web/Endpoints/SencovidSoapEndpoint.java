package com.api.myapp.web.Endpoints;

import com.api.myapp.domain.Covid;
import com.api.myapp.repository.CovidRepository;
import com.api.myapp.wsdl.GetCovid19InfoRequest;
import com.api.myapp.wsdl.GetCovid19InfoResponse;
import com.api.myapp.wsdl.GetInfoRequest;
import com.api.myapp.wsdl.GetInfoResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ws.server.endpoint.annotation.Endpoint;

import javax.xml.datatype.DatatypeFactory;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ws.server.endpoint.annotation.Endpoint;
import org.springframework.ws.server.endpoint.annotation.PayloadRoot;
import org.springframework.ws.server.endpoint.annotation.RequestPayload;
import org.springframework.ws.server.endpoint.annotation.ResponsePayload;

import javax.xml.crypto.Data;
import javax.xml.datatype.DatatypeConfigurationException;
import javax.xml.datatype.DatatypeFactory;
import javax.xml.datatype.XMLGregorianCalendar;
import java.time.Instant;
import java.time.LocalDate;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.Optional;

@Endpoint
public class SencovidSoapEndpoint {

    @Autowired
    CovidRepository sencovidRepository;

    DatatypeFactory datatypeFactory;

    {
        try {
            datatypeFactory = DatatypeFactory.newInstance();
        } catch (DatatypeConfigurationException e) {
            e.printStackTrace();
        }
    }

    GregorianCalendar calendarExpected = new GregorianCalendar(2018, 6, 28);
    XMLGregorianCalendar expectedXMLGregorianCalendar = datatypeFactory
        .newXMLGregorianCalendar(calendarExpected);

    LocalDate localDate = LocalDate.of(2019, 4, 25);

    XMLGregorianCalendar xmlGregorianCalendar =
        datatypeFactory.newXMLGregorianCalendar(localDate.toString());


    @PayloadRoot(namespace = "http://ws.groupeisi.com",localPart = "getInfoRequest")
    public @ResponsePayload
    GetInfoResponse getInfoRequest (@RequestPayload GetInfoRequest request) {
        GetInfoResponse response= new GetInfoResponse();
        response.setOutput("Bonjour M2GL "+ request.getInput());
        return response;
    }

    @PayloadRoot(namespace = "http://ws.groupeisi.com",localPart = "getCovid19InfoRequest")
    public @ResponsePayload
    GetCovid19InfoResponse getCovid19InfoRequest (@RequestPayload GetCovid19InfoRequest request) throws DatatypeConfigurationException {
        GetCovid19InfoResponse covidresponse= new GetCovid19InfoResponse();
        long bb = Long.parseLong(request.getInput());
        System.out.println("Input");
        System.out.println(bb);
        //Sencovid sencovid = sencovidRepository.getCovidInfoById((long)11);
        Optional<Covid> sencovid = sencovidRepository.findById(bb);
        XMLGregorianCalendar dateFormat =
            datatypeFactory.newXMLGregorianCalendar(sencovid.get().getDate().toString());
        covidresponse.setNbrtest(sencovid.get().getNbrtest());
        covidresponse.setNegatif(sencovid.get().getNegatif());
        covidresponse.setPostif(sencovid.get().getPositif());
        covidresponse.setDeces(sencovid.get().getDeces());
        covidresponse.setGueris(sencovid.get().getGueris());
        covidresponse.setDate(dateFormat);
        return covidresponse;
    }

    /*public Date StringToDate(String s){

        Date result = null;
        try{
            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
            result  = dateFormat.parse(s);
        }

        catch(ParseException e){
            e.printStackTrace();

        }
        return result ;
    }*/
}

