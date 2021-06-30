package org.sid.costomerservice;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import org.sid.costomerservice.entity.*;

import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.rest.core.annotation.RepositoryRestResource;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.ToString;



@RepositoryRestResource
interface CustomerRepository extends JpaRepository<Customer,Long>{
	
}

@SpringBootApplication
public class CostomerServiceApplication {

	public static void main(String[] args) {
		SpringApplication.run(CostomerServiceApplication.class, args);
	}
	@Bean
	CommandLineRunner start(CustomerRepository customerRepository) {
		return args -> {
			customerRepository.save(new Customer(null,"keita","keita@gmail.com"));
			//customerRepository.save(new Customer(2,"keita","keita@gmail.com"));
		};
	}

}
