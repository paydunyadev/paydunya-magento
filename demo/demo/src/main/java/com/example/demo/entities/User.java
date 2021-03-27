package com.example.demo.entities;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import org.hibernate.annotations.Proxy;

import javax.persistence.*;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;
import java.io.Serializable;
import java.util.Date;
import java.util.List;

@Entity
@Table(name = "users")
@Proxy(lazy = false)
@JsonIgnoreProperties(ignoreUnknown = false)
@XmlRootElement
public class User implements Serializable {

	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	@Basic(optional = false)
	@Column(name = "id")
	private Integer id;
	
	@Column(name = "firstname")
	private String firstname;
	
	@Column(name = "lastname")
	private String lastname;
	
	@Column(name = "profession")
	private String profession;
	
	@Column(name = "country")
	private String country;
	
	@Column(name = "town")
	private String town;
	
	@Column(name = "address")
	private String address;
	
	@Column(name = "phone")
	private String phone;
	
	@Column(name = "fax")
	private String fax;
	
	@Column(name = "email")
	private String email;
	
	@Column(name = "username")
	private String username;
	
	@Column(name = "password")
	private String password;
	
	@Column(name = "is_active")
	private boolean isActive;
	
	@Column(name = "is_blacklisted")
	private boolean isBlacklisted;
	
	@Column(name = "created_at")
	private Date createdAt;
	
	@JoinColumn(name = "profile", referencedColumnName = "id")
	@ManyToOne(optional = false, fetch = FetchType.LAZY)
	private Profile profile;
	
	@JoinColumn(name = "company", referencedColumnName = "id")
	@ManyToOne(optional = true, fetch = FetchType.LAZY)
	private Company company;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserReset> userResetList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Ppm> ppmList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Document> createDocumentList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserFileNotice> fileNoticeList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserFileDoc> fileDocList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserLetter> userLetterList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Request> requestList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Response> createResponseList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Commission> createCommissionList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserCommission> userCommissionList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserCommission> createUserCommissionList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserMeeting> userMeetingList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Pv> pvCreateList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserPv> userPvList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Extension> extensionList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Message> messageList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<OpenSession> openSessionList;
	
	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserOpenSession> userOpenSessionList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Recourse> recourseList;
	
	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<RecourseResp> recourseRespList;

	@OneToMany(mappedBy = "createdBy", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<Postponement> cReportList;

	@OneToMany(mappedBy = "user", cascade = CascadeType.ALL, fetch = FetchType.LAZY)
	@JsonIgnore
	private List<UserReport> uReportList;

	public User() {}
	
	public User(Integer id) {
		this.id = id;
	}

	public User(String firstname, String lastname, String profession, String country, String town,
                String address, String phone, String fax, String email, String username, String password, boolean isActive,
                boolean isBlacklisted, Date createdAt, Profile profile, Company company) {
		this.firstname = firstname;
		this.lastname = lastname;
		this.profession = profession;
		this.country = country;
		this.town = town;
		this.address = address;
		this.phone = phone;
		this.fax = fax;
		this.email = email;
		this.username = username;
		this.password = password;
		this.isActive = isActive;
		this.isBlacklisted = isBlacklisted;
		this.createdAt = createdAt;
		this.profile = profile;
		this.company = company;
	}
	
	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getFirstname() {
		return firstname;
	}

	public void setFirstname(String firstname) {
		this.firstname = firstname;
	}

	public String getLastname() {
		return lastname;
	}

	public void setLastname(String lastname) {
		this.lastname = lastname;
	}

	public String getProfession() {
		return profession;
	}

	public void setProfession(String profession) {
		this.profession = profession;
	}

	public String getCountry() {
		return country;
	}

	public void setCountry(String country) {
		this.country = country;
	}

	public String getTown() {
		return town;
	}

	public void setTown(String town) {
		this.town = town;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}

	public String getFax() {
		return fax;
	}

	public void setFax(String fax) {
		this.fax = fax;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
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

	public boolean isActive() {
		return isActive;
	}

	public void setActive(boolean isActive) {
		this.isActive = isActive;
	}

	public boolean isBlacklisted() {
		return isBlacklisted;
	}

	public void setBlacklisted(boolean isBlacklisted) {
		this.isBlacklisted = isBlacklisted;
	}
	
	public Date getCreatedAt() {
		return createdAt;
	}

	public void setCreatedAt(Date createdAt) {
		this.createdAt = createdAt;
	}

	public Profile getProfile() {
		return profile;
	}

	public void setProfile(Profile profile) {
		this.profile = profile;
	}

	public Company getCompany() {
		return company;
	}

	public void setCompany(Company company) {
		this.company = company;
	}

	@XmlTransient
	public List<UserReset> getUserResetList() {
		return userResetList;
	}

	public void setUserResetList(List<UserReset> userResetList) {
		this.userResetList = userResetList;
	}

	@XmlTransient
	public List<Ppm> getPpmList() {
		return ppmList;
	}

	public void setPpmList(List<Ppm> ppmList) {
		this.ppmList = ppmList;
	}

	@XmlTransient
	public List<Document> getCreateDocumentList() {
		return createDocumentList;
	}

	public void setCreateDocumentList(List<Document> createDocumentList) {
		this.createDocumentList = createDocumentList;
	}

	@XmlTransient
	public List<UserFileNotice> getFileNoticeList() {
		return fileNoticeList;
	}

	public void setFileNoticeList(List<UserFileNotice> fileNoticeList) {
		this.fileNoticeList = fileNoticeList;
	}

	@XmlTransient
	public List<UserFileDoc> getFileDocList() {
		return fileDocList;
	}

	public void setFileDocList(List<UserFileDoc> fileDocList) {
		this.fileDocList = fileDocList;
	}

	@XmlTransient
	public List<UserLetter> getUserLetterList() {
		return userLetterList;
	}

	public void setUserLetterList(List<UserLetter> userLetterList) {
		this.userLetterList = userLetterList;
	}

	@XmlTransient
	public List<Request> getRequestList() {
		return requestList;
	}

	public void setRequestList(List<Request> requestList) {
		this.requestList = requestList;
	}

	@XmlTransient
	public List<Response> getCreateResponseList() {
		return createResponseList;
	}

	public void setCreateResponseList(List<Response> createResponseList) {
		this.createResponseList = createResponseList;
	}

	@XmlTransient
	public List<Commission> getCreateCommissionList() {
		return createCommissionList;
	}

	public void setCreateCommissionList(List<Commission> createCommissionList) {
		this.createCommissionList = createCommissionList;
	}

	@XmlTransient
	public List<UserCommission> getUserCommissionList() {
		return userCommissionList;
	}

	public void setUserCommissionList(List<UserCommission> userCommissionList) {
		this.userCommissionList = userCommissionList;
	}

	@XmlTransient
	public List<UserCommission> getCreateUserCommissionList() {
		return createUserCommissionList;
	}

	public void setCreateUserCommissionList(List<UserCommission> createUserCommissionList) {
		this.createUserCommissionList = createUserCommissionList;
	}

	@XmlTransient
	public List<UserMeeting> getUserMeetingList() {
		return userMeetingList;
	}

	public void setUserMeetingList(List<UserMeeting> userMeetingList) {
		this.userMeetingList = userMeetingList;
	}

	@XmlTransient
	public List<Pv> getPvCreateList() {
		return pvCreateList;
	}

	public void setPvCreateList(List<Pv> pvCreateList) {
		this.pvCreateList = pvCreateList;
	}

	@XmlTransient
	public List<UserPv> getUserPvList() {
		return userPvList;
	}

	public void setUserPvList(List<UserPv> userPvList) {
		this.userPvList = userPvList;
	}

	@XmlTransient
	public List<Extension> getExtensionList() {
		return extensionList;
	}

	public void setExtensionList(List<Extension> extensionList) {
		this.extensionList = extensionList;
	}

	@XmlTransient
	public List<Message> getMessageList() {
		return messageList;
	}

	public void setMessageList(List<Message> messageList) {
		this.messageList = messageList;
	}

	@XmlTransient
	public List<OpenSession> getOpenSessionList() {
		return openSessionList;
	}

	public void setOpenSessionList(List<OpenSession> openSessionList) {
		this.openSessionList = openSessionList;
	}

	@XmlTransient
	public List<UserOpenSession> getUserOpenSessionList() {
		return userOpenSessionList;
	}

	public void setUserOpenSessionList(List<UserOpenSession> userOpenSessionList) {
		this.userOpenSessionList = userOpenSessionList;
	}

	@XmlTransient
	public List<Recourse> getRecourseList() {
		return recourseList;
	}

	public void setRecourseList(List<Recourse> recourseList) {
		this.recourseList = recourseList;
	}

	@XmlTransient
	public List<RecourseResp> getRecourseRespList() {
		return recourseRespList;
	}

	public void setRecourseRespList(List<RecourseResp> recourseRespList) {
		this.recourseRespList = recourseRespList;
	}

	@XmlTransient
	public List<Postponement> getcReportList() {
		return cReportList;
	}

	public void setcReportList(List<Postponement> cReportList) {
		this.cReportList = cReportList;
	}

	@XmlTransient
	public List<UserReport> getuReportList() {
		return uReportList;
	}

	public void setuReportList(List<UserReport> uReportList) {
		this.uReportList = uReportList;
	}
}
