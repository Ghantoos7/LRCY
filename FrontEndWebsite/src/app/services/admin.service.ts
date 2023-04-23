import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  branch_id: string="";

  constructor(private http:HttpClient) { }

  base_url = "http://localhost:8000/api/v0.1/admin";

  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getRequests(branch_id: string){
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + '/get_requests/' + branch_id, { headers: headers });
    return response;
  }

}
