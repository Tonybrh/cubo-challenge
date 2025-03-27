import React, {useState} from 'react';
import {useNavigate} from 'react-router-dom';
import axios from 'axios';
import Cookies from 'js-cookie';
import * as S from './style';

export default function AuthForm() {
    const [mode, setMode] = useState('login');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [name, setName] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');

        const url = mode === 'login'
            ? 'http://localhost:8081/api/auth/user/login'
            : 'http://localhost:8081/api/auth/user/create';

        try {
            const response = await axios.post(url, {
                email,
                password,
                ...(mode === 'register' && {name})
            });
            Cookies.set('authToken', response.data.accessToken, {
                expires: 1,
                secure: true,
                sameSite: 'strict'
            });
            navigate('/dashboard');
        } catch (err) {
            setError(err.response?.data?.message || 'Erro na autenticação');
        }
    };

    return (
        <S.Container>
            <S.AuthContainer>
                <S.Title>{mode === 'login' ? 'Login' : 'Cadastro'}</S.Title>

                {error && <S.ErrorMessage>{error}</S.ErrorMessage>}

                <S.Form onSubmit={handleSubmit}>
                    {mode === 'register' && (
                        <S.Input
                            type="text"
                            placeholder="Nome"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                            required
                        />
                    )}

                    <S.Input
                        type="email"
                        placeholder="Email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                    />

                    <S.Input
                        type="password"
                        placeholder="Senha"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        minLength="6"
                    />

                    <S.Button type="submit">
                        {mode === 'login' ? 'Entrar' : 'Cadastrar'}
                    </S.Button>
                </S.Form>

                <S.ToggleButton
                    type="button"
                    onClick={() => setMode(mode === 'login' ? 'register' : 'login')}
                >
                    {mode === 'login'
                        ? 'Não tem conta? Cadastre-se'
                        : 'Já tem conta? Faça login'}
                </S.ToggleButton>
            </S.AuthContainer>
        </S.Container>
    );
};
