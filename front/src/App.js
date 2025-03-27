import logo from './logo.svg';
import './App.css';
import {BrowserRouter, Routes, Route, Navigate} from "react-router-dom";
import Dashboard from "./Screens/Dashboard";
import { PrivateRoute } from "./Routes/PrivateRoute";
import {GlobalStyle} from "./Styles/global";
import AuthForm from "./Screens/AuthForm";

function App() {
  return (
      <>
          <GlobalStyle />
          <BrowserRouter>
              <Routes>
                  <Route path="/" element={<Navigate to="/auth" />} />
                  <Route path="/auth" element={<AuthForm />} />
                  <Route
                      path="/dashboard"
                      element={
                          <PrivateRoute>
                              <Dashboard />
                          </PrivateRoute>
                      }
                  />
              </Routes>
          </BrowserRouter>
      </>
  );
}

export default App;
