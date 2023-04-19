import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
private base_url = 'http://localhost:8000/api/v0.1/auth/';

  constructor(private http:HttpClient) { }

  /*get_user(branch: string, user_id: string){
    const response = this.http.get(this.base_url + 'get_user_info/' + branch + '/' + user_id);
  }*/

  signUp(organization_id: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id
    };

    const response = this.http.post(this.base_url + 'signup', body, options);

    return response;
  }

  login(organization_id: string, password: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'organization_id': organization_id,
      'password': password
    };

    const response = this.http.post(this.base_url + 'login', body, options);

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
  
}
