package com.example.demo.models;

import java.io.Serializable;

public class UserLogin implements Serializable {

	private static final long serialVersionUID = 1L;

	private String username;
	
	private String password;
	
	public UserLogin() {
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}
}
