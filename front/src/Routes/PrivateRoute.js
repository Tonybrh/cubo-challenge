import { Navigate } from 'react-router-dom';
import Cookies from 'js-cookie';

export const PrivateRoute = ({ children }) => {
    const token = Cookies.get('authToken');
    return token ? children : <Navigate to="/auth" />;
};
