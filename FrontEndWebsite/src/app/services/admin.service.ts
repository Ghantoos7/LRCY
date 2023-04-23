import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  branch_id: string="";

  constructor(private http:HttpClient) { }

  base_url = "http://localhost:8000/api/v0.1/admin/";
  base_url_event = "http://localhost:8000/api/v0.1/event/";


  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getRequests(branch_id: string){
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_requests/' + branch_id, { headers: headers });
    return response;
  }

  acceptRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'accept_request', body, options);
      return response;
  }

  declineRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'decline_request', body, options);
      return response;
  }

  getYearlyGoals(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_yearly_goals/' + id, { headers: headers });
    return response;
  }

}
