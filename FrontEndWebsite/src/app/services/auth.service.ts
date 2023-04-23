import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http:HttpClient) { }

  private base_url = 'http://localhost:8000/api/v0.1/auth/';

  adminLogin(organization_id: string, password: string) {
    const headers: HttpHeaders = new HttpHeaders({
      'Content-Type': 'application/json'
    });
    const options = { headers: headers };

    const body = {
      organization_id: organization_id,
      password: password
    };

    const response = this.http.post(this.base_url + 'admin_login', body, options);

    return response;

  }
}
