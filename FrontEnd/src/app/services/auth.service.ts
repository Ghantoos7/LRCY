import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})

export class AuthService {
  private base_url = 'http://localhost:8000/api/v0.1/auth/';

  constructor(private http:HttpClient) { }

  private saved_id = '';

  signUp(organization_id: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id
    };

    this.saved_id=organization_id;

    const response = this.http.post(this.base_url + 'signup', body, options);
    
    const data = JSON.parse(JSON.stringify(response));

    return response;
  }

  login(organization_id: string, password: string, rememberMe: boolean) {
    const headers: HttpHeaders = new HttpHeaders({
      'Content-Type': 'application/json'
    });
    const options = { headers: headers };

    const body = {
      organization_id: organization_id,
      password: password
    };

    const response = this.http.post(this.base_url + 'login', body, options);

    if (rememberMe) {
      localStorage.setItem('orgId', organization_id);
      localStorage.setItem('password', password);
    } else {
      localStorage.removeItem('orgId');
      localStorage.removeItem('password');
    }

    return response;
  }

  recoverRequest(organization_id: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id
    };

    const response = this.http.post(this.base_url + 'recover_request', body, options);

    return response;
  }

  checkRequestStatus(organization_id: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id
    };

    const response = this.http.post(this.base_url + 'check_request_status', body, options);
    
    return response;
  }

  register(username:string, password: string, confirm_password: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': this.saved_id,
      'username': username,
      'password': password,
      'confirm_password': confirm_password
    };

    const response = this.http.post(this.base_url + 'register', body, options);

    return response;
  }

  changePassword(organization_id:string, password: string, confirm_password: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id,
      'password': password,
      'confirm_password': confirm_password
    };

    const response = this.http.post(this.base_url + 'change_password', body, options);

    return response;
  }

}
