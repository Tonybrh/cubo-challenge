import React, { useEffect, useState } from 'react';
import api from '../../Utils/api'
import Cookies from 'js-cookie';
import * as S from './style'


export default function Dashboard() {
    const [user, setUser] = useState(null);

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await api.get('/auth/user');
                setUser(response.data);
            } catch (error) {
                console.error('Failed to fetch user', error);
            }
        };
        fetchUser();
    }, []);

    const handleLogout = () => {
        Cookies.remove('authToken');
        window.location.href = '/auth';
    };

    return (
        <S.DashboardContainer>
            <S.Header>
                <S.Title>Dashboard</S.Title>
                <S.LogoutButton onClick={handleLogout}>Sair</S.LogoutButton>
            </S.Header>

            {user && (
                <p>Bem-vindo, {user.name}</p>
            )}
        </S.DashboardContainer>
    );
};
