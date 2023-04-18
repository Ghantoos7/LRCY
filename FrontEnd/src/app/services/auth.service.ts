import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
private base_url = 'http://localhost:8000/api/v0.1/user/';

  constructor(private http:HttpClient) { }

  get_user(branch: string, user_id: string){
    const response = this.http.get(this.base_url + 'get_user_info/' + branch + '/' + user_id);
    return response;
  }
}
