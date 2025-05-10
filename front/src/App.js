import logo from './logo.svg';
import './App.css';
import {BrowserRouter, Routes, Route, Navigate} from "react-router-dom";
import Dashboard from "./Pages/DashboardPage";
import {PrivateRoute} from "./Routes/PrivateRoute";
import {GlobalStyle} from "./Styles/global";
import AuthForm from "./Pages/AuthFormPage";
import EditTaskPage from "./Pages/EditPage";
import CreateTaskPage from "./Pages/CreatePage";
import TaskCommentsPage from "./Pages/TaskCommentPage";

function App() {
    return (
        <>
            <GlobalStyle/>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Navigate to="/auth"/>}/>
                    <Route path="/auth" element={<AuthForm/>}/>
                    <Route
                        path="/dashboard"
                        element={
                            <PrivateRoute>
                                <Dashboard/>
                            </PrivateRoute>
                        }
                    />
                    <Route
                        path="/edit-task/:taskId"
                        element={
                            <PrivateRoute>
                                <EditTaskPage/>
                            </PrivateRoute>
                        }
                    />
                    <Route
                        path="/create-task"
                        element={
                            <PrivateRoute>
                                <CreateTaskPage/>
                            </PrivateRoute>
                        }
                    />
                    <Route
                        path="/task/:taskId/comments"
                        element={
                            <PrivateRoute>
                                <TaskCommentsPage/>
                            </PrivateRoute>
                        }
                    />
                </Routes>
            </BrowserRouter>
        </>
    );
}

export default App;
